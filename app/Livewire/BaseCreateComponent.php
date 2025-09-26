<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class BaseCreateComponent extends Component
{
    public  $isActive = true, $note;
    public $open = false;

     #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->resetForm();
    }

    
    public function render()
    {
        return view('admin.base-create-component');
    }
}
