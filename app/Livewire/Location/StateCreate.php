<?php

namespace App\Livewire\Location;

use App\Models\State;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class StateCreate extends Component
{
    public $name , $isActive = true, $note;
    public $open = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:states,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        State::create([
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('state-created');
        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        return view('admin.location.state-create');
    }
}
