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
use App\Traits\DeleteFilterReset;
use App\Traits\RestoreAndDeleteTrait;

class PersonnelBalanceTable extends Component
{


    use WithPagination;
    use HasSortable;
    use RestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset, PaginateReset;

    public $search = '';
    public $activeFilter = 'all';
    public $deletedFilter = 'without';
    public $pagination = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $modelClass = PersonnelBalance::class;

    public $personnelId;

    public $personnels;
    public $dateRange = ''; // SelectBox'tan gelen tarih aralığı seçimi



    public function calculateCurrentBalance()
    {
        $this->personnels = Personnel::all()->map(function ($personnel) {
            // Nakit girişleri toplamı
            $cashInTotal = PersonnelBalance::where('personnel_id', $personnel->id)->sum('cash_in');

            // Nakit çıkışları toplamı
            $cashOutTotal = PersonnelBalance::where('personnel_id', $personnel->id)->sum('cash_out');

            // Nakit harcamalar toplamı (PersonnelExpense tablosunda ödeme yöntemi "Nakit" olanlar)
            $cashExpenseTotal = PersonnelExpense::where('personnel_id', $personnel->id)
                ->where('payment_method', 'Nakit')
                ->sum('amount');

            // Mevcut bakiye: girişler - çıkışlar - nakit harcamalar
            $personnel->current_balance = $cashInTotal - $cashOutTotal - $cashExpenseTotal;

            return $personnel;
        });
    }

       // Bakiyeler güncellendiğinde hesaplamaları tetikleyen olaylar
       #[On('balance-edited')]
       #[On('balance-created')]
       #[On('balance-trashed')]
       #[On('balance-deleted')]
       public function updateBalances()
       {
           $this->calculateCurrentBalance();
       }


    public function render()
    {
        // Nakit girişlerini al
        $balanceRecords = PersonnelBalance::filter($this->search, $this->deletedFilter)
        ->sortable($this->sortField, $this->sortDirection)
        ->paginate($this->pagination);
        $this->calculateCurrentBalance();

        return view('admin.finance.personnel-balance-table', [
            'balanceRecords' => $balanceRecords,
            'personnels' => $this->personnels
        ]);
    }
}
