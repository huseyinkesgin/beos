<?php

namespace App\Livewire\Finance;

use Carbon\Carbon;
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

class PersonnelExpenseTable extends Component
{
    use WithPagination;
    use HasSortable;
    use RestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset, PaginateReset;

    public $search = '';
    public $deletedFilter = 'without';
    public $pagination = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $modelClass = PersonnelExpense::class;


    public $dateRange = ''; // SelectBox'tan gelen tarih aralığı seçimi
    public $paymentMethod = null;

    public $thisMonthTotals = [];
    public $thisYearTotals = [];
    public $paymentMethodMonthTotals = [];
    public $paymentMethodYearTotals = [];
    public $personnels;


    public function mount()
    {
        // Totalleri hesaplama fonksiyonları
        $this->calculateTotals();
        $this->calculatePaymentMethodTotals();

        // Personellerin güncel balance'larını hesapla
        $this->personnels = Personnel::all()->map(function ($personnel) {
            $personnel->current_balance = PersonnelBalance::calculateBalance($personnel->id);
            return $personnel;
        });
    }

    // Harcama türüne göre ay ve yıl toplamlarını hesapla
    public function calculateTotals()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $types = ['Market', 'Pazar', 'Ofis', 'Araç', 'Su', 'Diğer'];

        foreach ($types as $type) {
            // Bu ayki toplamı
            $this->thisMonthTotals[$type] = PersonnelExpense::where('expense_type', $type)
                ->whereYear('expense_date', $currentYear)
                ->whereMonth('expense_date', $currentMonth)
                ->sum('amount');

            // Bu yılki toplamı
            $this->thisYearTotals[$type] = PersonnelExpense::where('expense_type', $type)
                ->whereYear('expense_date', $currentYear)
                ->sum('amount');
        }
    }

    // Ödeme yöntemine göre ay ve yıl toplamlarını hesapla
    public function calculatePaymentMethodTotals()
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $methods = ['Nakit', 'Kredi Kartı'];

        foreach ($methods as $method) {
            // Bu ayki toplamı (Ödeme Yöntemi)
            $this->paymentMethodMonthTotals[$method] = PersonnelExpense::where('payment_method', $method)
                ->whereYear('expense_date', $currentYear)
                ->whereMonth('expense_date', $currentMonth)
                ->sum('amount');

            // Bu yılki toplamı (Ödeme Yöntemi)
            $this->paymentMethodYearTotals[$method] = PersonnelExpense::where('payment_method', $method)
                ->whereYear('expense_date', $currentYear)
                ->sum('amount');
        }
    }



    #[On('expense-created')]
    #[On('expense-edited')]
    #[On('expense-trashed')]
    #[On('expense-deleted')]
    #[On('balance-created')]
    #[On('balance-edited')]
    public function render()
    {
        // Totalleri yeniden hesapla
        $this->calculateTotals();
        $this->calculatePaymentMethodTotals();
        
        // Personel bakiyelerini yeniden hesapla
        $this->personnels = Personnel::all()->map(function ($personnel) {
            $personnel->current_balance = PersonnelBalance::calculateBalance($personnel->id);
            return $personnel;
        });

        $expenses = PersonnelExpense::filter($this->search, $this->deletedFilter)
        ->filterByDateRange($this->dateRange) // Trait'teki tarih aralığı filtresini kullanıyoruz
        ->orderBy($this->sortField, $this->sortDirection)
        ->paginate($this->pagination);

        return view('admin.finance.personnel-expense-table', [
            'expenses' => $expenses,
            'thisMonthTotals' => $this->thisMonthTotals,
            'thisYearTotals' => $this->thisYearTotals,
            'paymentMethodMonthTotals' => $this->paymentMethodMonthTotals,
            'paymentMethodYearTotals' => $this->paymentMethodYearTotals,
            'personnels' => $this->personnels
        ]);
    }
}
