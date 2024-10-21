<?php

namespace App\Livewire\Finance;

use Livewire\Component;
use Livewire\Attributes\Title;

class BillIndex extends Component
{
    #[Title('Gider Fatura Paneli')]
    public function render()
    {
        return view('admin.finance.bill-index');
    }
}
