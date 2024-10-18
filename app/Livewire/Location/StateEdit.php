<?php

namespace App\Livewire\Location;

use App\Models\State;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class StateEdit extends Component
{
    

    public $stateId;
    public $name;
    public $isActive;
    public $note;
    public $open = false;

    protected $listeners = ['openEditModal' => 'loadState'];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:states,name,' . $this->stateId,
            'isActive' => 'boolean',
            'note' => 'nullable|string',
        ];
    }
    public function openEditModal($id)
    {
        $this->loadState($id);
        $this->open = true;
    }

    public function loadState($id)
    {
        $state = State::findOrFail($id);
        $this->stateId = $state->id;
        $this->name = $state->name;
        $this->isActive = $state->isActive;
        $this->note = $state->note;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $state = State::findOrFail($this->stateId);
        $state->update([
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');

        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarıyla güncellendi!', type: 'success');

        $this->reset(['stateId', 'name', 'isActive', 'note', 'open']);
    }

    public function render()
    {
        return view('admin.location.state-edit');
    }
}
