<?php
/**
 * Personel harcamalarında nakit seçildiğinde, O personele ait
 * toplam bulunması gereken nakitden düşüyor ve şimdiki balansı buluyor.
 * paymetn_method
 */
namespace App\Livewire\Finance;

use Livewire\Component;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Models\PersonnelExpense;

class PersonnelExpenseCreate extends Component
{

    public $personnel_id , $expense_type, $note ,$amount , $payment_method ,$expense_date ,$has_receipt;
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

    #[On('openCreateModal')]
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

        // Nakit harcama yapıldığında PersonnelBalance güncellenmesi
        if ($this->payment_method === 'Nakit') {
            \App\Models\PersonnelBalance::updateBalance($this->personnel_id);
        }

        $this->dispatch('expense-created');
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
