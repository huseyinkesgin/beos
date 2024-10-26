<?php
namespace App\Livewire\Finance;

use Livewire\Component;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Models\PersonnelBalance;
use App\Models\PersonnelExpense;

class PersonnelBalanceTable extends Component
{
    public $personnelId;  // Bu değişken dışarıdan alınacak personel ID

    public $personnels;

    public $pagination = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

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
        // Nakit girişlerini al
        $balanceRecords = PersonnelBalance::paginate($this->pagination);

        return view('admin.finance.personnel-balance-table', [
            'balanceRecords' => $balanceRecords,
            'personnels' => $this->personnels
        ]);
    }
}
