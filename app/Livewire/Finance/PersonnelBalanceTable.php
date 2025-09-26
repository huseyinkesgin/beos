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
     public $modelClass = PersonnelBalance::class;

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
        // Tüm personeller ve doğru bakiye hesaplama
        $this->personnels = Personnel::all()->map(function ($personnel) {
            // Model metodunu kullanarak tutarlı hesaplama
            $personnel->current_balance = PersonnelBalance::calculateBalance($personnel->id);
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
