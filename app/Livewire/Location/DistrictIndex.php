<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\Title;

class DistrictIndex extends Component
{
    #[Title('İl Paneli')]
    public function render()
    {
        return view('admin.location.district-index');
    }
}
