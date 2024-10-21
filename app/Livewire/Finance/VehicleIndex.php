<?php

namespace App\Livewire\Finance;

use Livewire\Component;

class VehicleIndex extends Component
{
    #[On('Araç Listesi')]
    public function render()
    {
        return view('admin.finance.vehicle-index');
    }
}
