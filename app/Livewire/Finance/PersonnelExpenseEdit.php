<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Models\PersonnelExpense;

class PersonnelExpenseEdit extends Component
{

    public $personnel_id , $expense_type, $note ,$amount , $payment_method ,$expense_date ,$has_receipt;
    public $expenseId;
    public $open = false;

    protected function rules()
    {
        return [
        'personnel_id' => 'required|exists:personnels,id',
        'expense_type' => 'required|string|max:255',
        'note' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'payment_method' => 'required|string|max:255',
        'expense_date' => 'required|date',
        'has_receipt' => 'boolean',
        ];
    }
    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->loadExpense($id);
        $this->open = true;
    }

    public function loadExpense($id)
    {
        $expense = PersonnelExpense::findOrFail($id);
        $this->expenseId = $expense->id;
        $this->personnel_id = $expense->personnel_id;
        $this->expense_type = $expense->expense_type;
        $this->note = $expense->note;
        $this->amount = $expense->amount;
        $this->payment_method = $expense->payment_method;
        $this->expense_date = $expense->expense_date;
        $this->has_receipt = $expense->has_receipt;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $expense = PersonnelExpense::findOrFail($this->expenseId);
        $oldPersonnelId = $expense->personnel_id;
        $oldPaymentMethod = $expense->payment_method;
        
        $expense->update([
            'personnel_id' => $this->personnel_id,
            'expense_type' => $this->expense_type,
            'note' => $this->note,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'expense_date' => $this->expense_date,
            'has_receipt' => $this->has_receipt,
        ]);

        // Nakit harcama durumu değiştiyse balance güncellenmesi
        if ($oldPaymentMethod === 'Nakit' || $this->payment_method === 'Nakit') {
            \App\Models\PersonnelBalance::updateBalance($oldPersonnelId);
            if ($oldPersonnelId !== $this->personnel_id) {
                \App\Models\PersonnelBalance::updateBalance($this->personnel_id);
            }
        }

        $this->dispatch('expense-edited');

        $this->dispatch('notify', title: 'Başarılı', text: 'Harcama başarıyla güncellendi!', type: 'success');

        $this->reset(['expenseId', 'personnel_id', 'expense_type', 'note', 'amount', 'payment_method', 'expense_date', 'has_receipt', 'open']);
    }

    public function render()
    {
        $personnels = Personnel::active()->get();
        return view('admin.finance.personnel-expense-edit',[
            'personnels' => $personnels
    ]);
}
}
