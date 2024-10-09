<?php

namespace App\Livewire\Location;

use Livewire\Component;

class StateIndex extends Component
{
    public function render()
    {
        return view('admin.location.state-index')->layout('layouts.app');
    }
}
