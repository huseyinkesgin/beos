<?php

namespace App\Livewire\Finance;

use App\Models\Bill;
use Livewire\Component;
use Livewire\Attributes\On;

class BillCreate extends Component
{
    public $type, $amount, $payment_date,$bill_date, $payment_method,$last_date, $bill_no, $status, $is_recurring = false;

    public $open = false;

    protected $rules = [
        'type' =>  ['required', 'string'],
        'amount' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        'payment_method' => 'required|string',
        'last_date' => 'required|date',
        'bill_no' => 'required|string',
        'last_date' => 'required|date',
        'bill_date' => 'required|date',
        'is_recurring' => 'boolean',

    ];

    protected $messages = [
        'type.required' => 'Fatura türü gereklidir.',
        'amount.required' => 'Tutar gereklidir.',
        'amount.numeric' => 'Tutar geçerli bir sayı olmalıdır.',
        'amount.regex' => 'Tutar en fazla iki ondalık basamak içerebilir.',
        'payment_method.required' => 'Ödeme yöntemi gereklidir.',
        'last_date.required' => 'Son ödeme tarihi gereklidir.',
        'last_date.date' => 'Son ödeme tarihi geçerli bir tarih olmalıdır.',
        'bill_no.required' => 'Fatura numarası gereklidir.',
        'bill_date.required' => 'Fatura tarihi gereklidir.',
        'bill_date.date' => 'Fatura tarihi geçerli bir tarih olmalıdır.',
        'is_recurring.boolean' => 'Düzenli fatura değeri geçersiz.',
    ];

    #[On('openCreateModal')]
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
            'payment_method' => $this->payment_method,
            'last_date' => $this->last_date,
            'bill_date' => $this->bill_date,
            'is_recurring' => $this->is_recurring,
            'bill_no' => $this->bill_no,
            // 'status' => $this->status,
        ]);

        $this->dispatch('bill-created');
        $this->dispatch('notify', title: 'Başarılı', text: 'Fatura başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }

    public function render()
    {
        return view('admin.finance.bill-create');
    }
}
