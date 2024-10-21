<?php

namespace App\Livewire\Finance;

use App\Models\Bill;
use Livewire\Component;
use App\Traits\HasSortable;
use App\Traits\SearchReset;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Traits\PaginateReset;
use App\Traits\ActiveFilterReset;
use App\Traits\DeleteFilterReset;
use App\Traits\ToggleActiveTrait;
use App\Traits\RestoreAndDeleteTrait;

class BillTable extends Component
{
    use WithPagination;
    use HasSortable;
    use ToggleActiveTrait,RestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset, ActiveFilterReset, PaginateReset;

    public $search = '';
    public $activeFilter = 'all';
    public $deletedFilter = 'without';
    public $pagination = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $modelClass = Bill::class;

    public $selectedBillId = null;
    public $showSelectBox = false;

    public $this_month_unpaid_total = 0;
    public $this_month_paid_total = 0;
    public $this_year_paid_total = 0;


     // Yeni özellikler:
     public $editableBillId = null;  // Hangi satır düzenleniyor
     public $editableField = null;   // Hangi alan düzenleniyor
     public $payment_date = null;


    public function mount()
    {
        $this->calculateTotals();
    }

    public function updated($propertyName)
    {
        $this->calculateTotals();
    }


    /**
     * Fatura durumunu değiştirmek için üzerine tıkladığında
     * selectbox'ın açılması için gereken fonkiyon
     *
     * @param [type] $billId
     * @return void
     */
    public function toggleSelectBox($billId)
    {
        $this->selectedBillId = $this->selectedBillId == $billId ? null : $billId;
        $this->showSelectBox = ! $this->showSelectBox;
    }



     /**
      * Eğer ödenecek statüsünden ödendi statüsüne getirilirse,
      * Ödeme tarihinin ne zaman yapıldığını buradan tarih seçererek
      * yapabiliyoruz
      * @param [type] $billId
      * @param [type] $field
      * @return void
      */
     public function editField($billId, $field)
     {
         $this->editableBillId = $billId;
         $this->editableField = $field;
         $bill = Bill::find($billId);
         $this->payment_date = $bill->payment_date;  // Eğer payment_date düzenleniyorsa, mevcut değeri al
     }

     /**
      * editField fonksiyonu çalıştığında tarih girip kayıt
      * yapabilmemiz için gerekli fonksion
      * @param [type] $billId
      * @return void
      */
     public function saveField($billId)
     {
         $bill = Bill::find($billId);

         if ($this->editableField === 'payment_date' && $bill->status == 'Ödendi') {
            // Eğer payment_date boş değilse, Carbon ile formatla ve kaydet
            $bill->payment_date = $this->payment_date ? \Carbon\Carbon::parse($this->payment_date) : null;
        }

         $bill->save();
         $this->editableBillId = null;
         $this->editableField = null;

         $this->dispatch('notify', title: 'Başarılı', text: 'Ödeme tarihi başarıyla güncellendi!', type: 'success');
     }

     /**
      * Tüm faturaların ödenecek ve ödendi toplamlarını
      * hesaplamak için
      * @return void
      */
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

    /**
     * Faturaların tablo üzerinde statüsünü tıklayarak, düzenlemeye
     * girmeden değiştirmek için gerekli fonksiyon
     * @param [type] $billId
     * @param [type] $newStatus
     * @return void
     */
    public function updateStatus($billId, $newStatus)
    {
        $bill = Bill::findOrFail($billId);
        $bill->status = $newStatus;

        if ($newStatus == 'Ödendi') {
            // Ödendi olduğunda ödeme tarihini bugünün tarihi yapıyoruz
            $bill->payment_date = now();
        } elseif ($newStatus == 'Ödenecek') {
            // Ödenecek olduğunda ödeme tarihini sıfırlamayın, mevcut haliyle bırakın
            // İsteğe bağlı olarak null yapabilirsiniz ancak hesaplamalar etkilenir
             $bill->payment_date = null;
        }

        $bill->save();

        $this->calculateTotals(); // Her güncellemeden sonra toplamları yeniden hesapla
        $this->selectedBillId = null;
        $this->showSelectBox = false;

        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura durumu güncellendi!', type: 'success');
        $this->dispatch('bill-edited');
    }

    #[On('bill-created')]
    #[On('bill-edited')]
    #[On('bill-trashed')]
    #[On('bill-deleted')]
    public function render()
    {
        $bills = Bill::filter($this->search, $this->deletedFilter)
            ->sortable($this->sortField, $this->sortDirection)
            ->paginate($this->pagination);
            $this->calculateTotals();
        return view('admin.finance.bill-table', [
            'bills' => $bills,
            'this_month_unpaid_total' => $this->this_month_unpaid_total,
            'this_month_paid_total' => $this->this_month_paid_total,
            'this_year_paid_total' => $this->this_year_paid_total,
        ]);
    }
}
