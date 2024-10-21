<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use Livewire\Attributes\Title;

class PersonnelExpenseIndex extends Component
{
    #[Title('Personel Harcamaları')]
    public function render()
    {
        return view('admin.finance.personnel-expense-index');
    }
}
