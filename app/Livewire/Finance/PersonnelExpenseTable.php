<?php

namespace App\Livewire\Finance;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PersonnelExpense;

class PersonnelExpenseTable extends Component
{


    use WithPagination;

    public $search = '';

    public $deletedFilter = 'without';

    public $pagination = 10;

    public $sortField = 'created_at';

    public $sortDirection = 'asc';


    public $thisMonthTotals = [];
    public $thisYearTotals = [];
    public $paymentMethodMonthTotals = [];
    public $paymentMethodYearTotals = [];


    protected $listeners = ['refreshTable' => '$refresh']; // Tabloyu güncelleme
    public function mount()
    {
        $this->calculateTotals();
        $this->calculatePaymentMethodTotals();
    }

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



    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDeletedFilter()
    {
        $this->resetPage();
    }

    public function updatingPagination()
    {
        $this->resetPage();
    }




    public function render()
    {
        $expenses = PersonnelExpense::where('expense_type', 'like', '%' . $this->search . '%')
        ->orWhereHas('personnel', function ($query) {
            $query->where('first_name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('expense_date', 'desc') // Tarihe göre sıralama
        ->paginate($this->pagination);

        return view('admin.finance.personnel-expense-table', [
            'expenses' => $expenses,
            'thisMonthTotals' => $this->thisMonthTotals,
            'thisYearTotals' => $this->thisYearTotals,
            'paymentMethodMonthTotals' => $this->paymentMethodMonthTotals,
            'paymentMethodYearTotals' => $this->paymentMethodYearTotals,
        ]);
    }
}
