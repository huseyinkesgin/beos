<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\Title;

class StateIndex extends Component
{
    #[Title('İl Paneli')]
    public function render()
    {
        return view('admin.location.state-index')->layout('layouts.app');
    }
}
