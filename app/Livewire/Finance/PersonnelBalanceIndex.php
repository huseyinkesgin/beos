<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use Livewire\Attributes\Title;

class PersonnelBalanceIndex extends Component
{
    #[Title('Kasa Paneli')]
    public function render()
    {
        return view('admin.finance.personnel-balance-index');
    }
}
