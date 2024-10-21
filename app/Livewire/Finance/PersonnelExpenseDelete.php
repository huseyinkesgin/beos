<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\PersonnelExpense;

class PersonnelExpenseDelete extends Component
{
    public $expenseId;
    public $open = false;


    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->expenseId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $expense = PersonnelExpense::findOrFail($this->expenseId);
        $expense->delete();

        $this->dispatch('expense-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['expenseId', 'open']);
    }
    public function render()
    {
        return view('admin.finance.personnel-expense-delete');
    }
}
