<?php

namespace App\Livewire\Finance;

use App\Models\Bill;
use Livewire\Component;

class BillCreate extends Component
{
    public $type, $amount, $payment_date,$bill_date, $payment_method,$last_date, $bill_no, $status, $is_recurring = false;

    public $open = false;

    protected $rules = [
        'type' => 'required|string',
        'amount' => 'required|numeric',
        'payment_date' => 'required|date',
        'payment_method' => 'required|string',
        'bill_no' => 'required|string',
        'last_date' => 'required|date',
        'bill_date' => 'required|date',
        'is_recurring' => 'boolean',
        'status' => 'nullable',
    ];

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        Bill::create([
            'type' => $this->type,
            'amount' => $this->amount,
            'payment_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'last_date' => $this->last_date,
            'bill_date' => $this->bill_date,
            'is_recurring' => $this->is_recurring,
            'bill_no' => $this->bill_no,
            'status' => $this->status,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }

    public function render()
    {
        return view('admin.finance.bill-create');
    }
}
