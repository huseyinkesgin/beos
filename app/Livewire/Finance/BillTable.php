<?php

namespace App\Livewire\Finance;

use App\Models\Bill;
use App\Traits\HasSortable;
use Livewire\Component;
use Livewire\WithPagination;

class BillTable extends Component
{
    use HasSortable;
    use WithPagination;

    public $selectedBillId = null;
    public $showSelectBox = false;
    public $this_month_unpaid_total = 0;
    public $this_month_paid_total = 0;
    public $this_year_paid_total = 0;

    public $search = '';
    public $deletedFilter = 'without';
    public $pagination = 10;

    public $sortField = 'created_at';
    public $sortDirection = 'asc';

    protected $listeners = ['refreshTable' => '$refresh', 'refreshTotals' => 'calculateTotals'];

    public function mount()
    {
        $this->calculateTotals();
    }

    public function updated($propertyName)
    {
        $this->calculateTotals();
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

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }

    // Sıralama okunu döndürmek için metod
    public function getSortIcon($field)
    {
        if ($this->sortField === $field) {
            return $this->sortDirection === 'asc' ? '▲' : '▼';
        }

        return '';
    }

    public function toggleSelectBox($billId)
    {
        // Eğer tıklanan fatura daha önce seçilmemişse veya aynı fatura ise, select box açılır.
        $this->selectedBillId = $this->selectedBillId === $billId ? null : $billId;
        $this->showSelectBox = ! $this->showSelectBox;
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

    public function restore($id)
    {
        $bill = Bill::withTrashed()->findOrFail($id);
        $bill->restore();
        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura başarıyla çöp kutusundan kurtarıldı!', type: 'success');
        $this->dispatch('refreshTable');
    }

    public function forceDelete($id)
    {
        $bill = Bill::withTrashed()->findOrFail($id);
        $bill->forceDelete(); // Kalıcı olarak silme

        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura başarıyla tamamen silindi!', type: 'success');
        $this->dispatch('refreshTable');
    }

    public function calculateTotals()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Bu ay ödenmemiş toplamı
        $this->this_month_unpaid_total = Bill::where('status', 'Ödenecek')
            ->whereYear('bill_date', $currentYear)
            ->whereMonth('bill_date', $currentMonth)
            ->sum('amount');

        // Bu ay ödenmiş toplamı
        $this->this_month_paid_total = Bill::where('status', 'Ödendi')
            ->whereYear('payment_date', $currentYear)
            ->whereMonth('payment_date', $currentMonth)
            ->sum('amount');

        // Bu yıl ödenmiş toplamı
        $this->this_year_paid_total = Bill::where('status', 'Ödendi')
            ->whereYear('payment_date', $currentYear)
            ->sum('amount');
    }

    public function updateStatus($billId, $newStatus)
    {
        $bill = Bill::findOrFail($billId);
        $bill->status = $newStatus;

        if ($newStatus === 'Ödenecek') {
            $bill->payment_date = null;
        }

        $bill->save();

        $this->calculateTotals(); // her güncelleme sonrası yeniden hesapla
        $this->selectedBillId = null;
        $this->showSelectBox = false;

        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura durumu güncellendi!', type: 'success');
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        $bills = Bill::filter($this->search,  $this->deletedFilter)
            ->sortable($this->sortField, $this->sortDirection)
            ->paginate($this->pagination);

        return view('admin.finance.bill-table', [
            'bills' => $bills,
            'this_month_unpaid_total' => $this->this_month_unpaid_total,
            'this_month_paid_total' => $this->this_month_paid_total,
            'this_year_paid_total' => $this->this_year_paid_total,
        ]);
    }


}
