<?php

namespace App\Livewire\Location;

use App\Models\State;
use Livewire\Component;
use Illuminate\Support\Str;
use Laravel\Jetstream\InteractsWithBanner;

class StateCreate extends Component
{
    use InteractsWithBanner;
    public $name;
    public $isActive = true;
    public $note;
    public $open = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:states,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        State::create([
            'id' => (string) Str::uuid(),
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }
    

    public function render()
    {
        return view('admin.location.state-create');
    }
}
