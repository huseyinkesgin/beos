<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use App\Models\Personnel;
use App\Models\PersonnelExpense;

class PersonnelExpenseCreate extends Component
{

    public $personnel_id;
    public $expense_type;
    public $note;
    public $amount;
    public $payment_method;
    public $expense_date;
    public $has_receipt;
    public $open = false;

    protected $rules = [
        'personnel_id' => 'required|exists:personnels,id',
        'expense_type' => 'required|string|max:255',
        'note' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'payment_method' => 'required|string|max:255',
        'expense_date' => 'required|date',
        'has_receipt' => 'boolean',
    ];

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        PersonnelExpense::create([
            'personnel_id' => $this->personnel_id,
            'expense_type' => $this->expense_type,
            'note' => $this->note,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'expense_date' => $this->expense_date,
            'has_receipt' => $this->has_receipt,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Harcama başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }

    public function render()
    {
        $personnels = Personnel::active()->get();
        return view('admin.finance.personnel-expense-create',[
            'personnels' => $personnels
    ]);
    }
}
