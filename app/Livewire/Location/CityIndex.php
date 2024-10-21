<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\Title;

class CityIndex extends Component
{
    #[Title('İlçe Paneli')]
    public function render()
    {
        return view('admin.location.city-index');
    }
}
