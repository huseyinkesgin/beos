<?php
namespace App\Livewire\Finance;

use Livewire\Component;
use App\Models\Personnel;
use App\Traits\HasSortable;
use App\Traits\SearchReset;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Traits\PaginateReset;
use App\Models\PersonnelBalance;
use App\Models\PersonnelExpense;
use App\Traits\ActiveFilterReset;
use App\Traits\DeleteFilterReset;
use App\Traits\ToggleActiveTrait;
use App\Traits\RestoreAndDeleteTrait;

class PersonnelBalanceTable extends Component
{
    use WithPagination;
    use HasSortable;
    use RestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset,  PaginateReset;

    public $personnelId;  // Bu değişken dışarıdan alınacak personel ID

    public $personnels;

     /* ------------------------- Tablo Dışı Özellikler ------------------------- */
     public $search = '';
     public $deletedFilter = 'without';
     public $pagination = 10;
     public $sortField = 'created_at';
     public $sortDirection = 'desc';
     public $modelClass = City::class;

    // protected $listeners = ['refreshTable' => '$refresh'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function mount()
    {
        // Tüm personeller ve nakit giriş/çıkış ve harcama toplamlarını hesaplıyoruz
        $this->personnels = Personnel::all()->map(function ($personnel) {
            // Nakit girişleri toplamı
            $cashInTotal = PersonnelBalance::where('personnel_id', $personnel->id)
                ->sum('cash_in');

            // Nakit çıkışları toplamı
            $cashOutTotal = PersonnelBalance::where('personnel_id', $personnel->id)
                ->sum('cash_out');

            // Nakit harcamalar toplamı (PersonnelExpense tablosunda ödeme yöntemi "Nakit" olanlar)
            $cashExpenseTotal = PersonnelExpense::where('personnel_id', $personnel->id)
                ->where('payment_method', 'Nakit')
                ->sum('amount');

            // Mevcut bakiye: girişler - çıkışlar - nakit harcamalar
            $personnel->current_balance = $cashInTotal - $cashOutTotal - $cashExpenseTotal;

            return $personnel;
        });


    }

    #[On('balance-edited')]
    public function render()
{
    $balanceRecords = PersonnelBalance::paginate($this->pagination);


    // Nakit harcamaları al
    $expenses = PersonnelExpense::where('personnel_id', $this->personnelId)
        ->where('payment_method', 'Nakit')
        ->get();

        $pers = Personnel::with(['expenses' => function ($query) {
            $query->orderBy('expense_date', 'desc');
        }])->get();


    return view('admin.finance.personnel-balance-table', [
        'balanceRecords' => $balanceRecords,
        'pers' => $pers,
        'expenses' => $expenses
    ]);
}
}
