<?php

namespace App\Livewire;

use Livewire\Component;

class BaseComponent extends Component
{
    public function render()
    {
        return view('admin.base-component');
    }
}
