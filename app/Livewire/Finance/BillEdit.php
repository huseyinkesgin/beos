<?php

namespace App\Livewire\Finance;

use App\Models\Bill;
use Livewire\Component;
use Livewire\Attributes\On;

class BillEdit extends Component
{
   //TODO : DÜZENLEME YAPTIĞIMIZDA TARİHLER DÜZGÜN ÇIKMIYOR. DÜZELTİLECEK

   
    public $type, $amount, $payment_date,$bill_date, $payment_method,$last_date, $bill_no, $status, $is_recurring = false;
    public $billId;

    public $open = false;

    protected $rules = [
        'type' => 'required|string',
        'amount' => 'required|numeric',
        'payment_method' => 'required|string',
        'bill_no' => 'required|string',
        'last_date' => 'required|date',
        'bill_date' => 'required|date',
        'is_recurring' => 'boolean',

    ];


    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->loadBill($id);
        $this->open = true;
    }

    public function loadBill($id)
    {
        $bill = Bill::findOrFail($id);
        $this->billId = $bill->id;
        $this->type = $bill->type;
        $this->amount = $bill->amount;
        $this->payment_method = $bill->payment_method;
        $this->bill_no = $bill->bill_no;
        $this->last_date = optional($bill->last_date)->format('Y-m-d');  // Tarihi Y-m-d formatında al
        $this->bill_date = optional($bill->bill_date)->format('Y-m-d');
        $this->is_recurring = $bill->is_recurring;
        $this->status = $bill->status;
        $this->payment_date = optional($bill->payment_date)->format('Y-m-d');
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $bill = Bill::findOrFail($this->billId);
        $bill::update([
            'type' => $this->type,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'bill_no' => $this->bill_no,
            'last_date' => $this->last_date,
            'bill_date' => $this->bill_date,
            'is_recurring' => $this->is_recurring,
            'status' => $this->status,
            'payment_date' => $this->payment_date,
        ]);

        $this->dispatch('bill-edited');
        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        return view('admin.finance.bill-edit');
    }
}
