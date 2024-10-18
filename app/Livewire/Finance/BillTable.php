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

     // Yeni özellikler:
     public $editableBillId = null;  // Hangi satır düzenleniyor
     public $editableField = null;   // Hangi alan düzenleniyor
     public $payment_date = null;



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

    public function toggleSelectBox($billId)
    {
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
        $this->calculateTotals(); // Recalculate after restoring a bill
    }

    public function forceDelete($id)
    {
        $bill = Bill::withTrashed()->findOrFail($id);
        $bill->forceDelete();

        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura başarıyla tamamen silindi!', type: 'success');
        $this->dispatch('refreshTable');
        $this->calculateTotals(); // Recalculate after permanent deletion
    }

     // Satır içi düzenleme başlatmak için
     public function editField($billId, $field)
     {
         $this->editableBillId = $billId;
         $this->editableField = $field;
         $bill = Bill::find($billId);
         $this->payment_date = $bill->payment_date;  // Eğer payment_date düzenleniyorsa, mevcut değeri al
     }

     // Düzenlemeyi kaydetmek için
     public function saveField($billId)
     {
         $bill = Bill::find($billId);

         if ($this->editableField === 'payment_date') {
             // Eğer payment_date boş değilse, Carbon ile formatla ve kaydet
             $bill->payment_date = $this->payment_date ? \Carbon\Carbon::parse($this->payment_date) : null;
         }

         $bill->save();
         $this->editableBillId = null;
         $this->editableField = null;
         $this->calculateTotals(); // Kaydettikten sonra toplamları güncelle
         $this->dispatch('notify', title: 'Başarılı', text: 'Ödeme tarihi başarıyla güncellendi!', type: 'success');
     }


    public function calculateTotals()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // This month unpaid total
        $this->this_month_unpaid_total = Bill::whereRaw('TRIM(LOWER(status)) = ?', [strtolower('Ödenecek')])
            ->whereYear('last_date', $currentYear)
            ->whereMonth('last_date', $currentMonth)
            ->sum('amount');

        // This month paid total
        $this->this_month_paid_total = Bill::whereRaw('TRIM(LOWER(status)) = ?', [strtolower('Ödendi')])
            ->whereYear('last_date', $currentYear)
            ->whereMonth('last_date', $currentMonth)
            ->sum('amount');

        // This year paid total
        $this->this_year_paid_total = Bill::whereRaw('TRIM(LOWER(status)) = ?', [strtolower('Ödendi')])
            ->whereYear('last_date', $currentYear)
            ->sum('amount');
    }

    public function updateStatus($billId, $newStatus)
    {
        $bill = Bill::findOrFail($billId);
        $bill->status = $newStatus;

        if ($newStatus === 'Ödendi') {
            // Ödendi olduğunda ödeme tarihini bugünün tarihi yapıyoruz
            $bill->payment_date = now();
        } elseif ($newStatus === 'Ödenecek') {
            // Ödenecek olduğunda ödeme tarihini sıfırlamayın, mevcut haliyle bırakın
            // İsteğe bağlı olarak null yapabilirsiniz ancak hesaplamalar etkilenir
            // $bill->payment_date = null;
        }

        $bill->save();

        $this->calculateTotals(); // Her güncellemeden sonra toplamları yeniden hesapla
        $this->selectedBillId = null;
        $this->showSelectBox = false;

        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura durumu güncellendi!', type: 'success');
        $this->dispatch('refreshTable');
    }

    public function render()
    {
        $bills = Bill::filter($this->search, $this->deletedFilter)
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
