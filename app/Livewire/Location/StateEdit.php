<?php

namespace App\Livewire\Location;

use App\Models\State;
use Livewire\Component;
use Livewire\Attributes\On;

class StateEdit extends Component
{

    public $name , $isActive = true, $note;

    public $stateId;
    public $open = false;


    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:states,name,' . $this->stateId,
            'isActive' => 'boolean',
            'note' => 'nullable|string',
        ];
    }

    #[On('openEditModal')]
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

        $this->dispatch('state-edited');

        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarıyla güncellendi!', type: 'success');

        $this->reset(['stateId', 'name', 'isActive', 'note', 'open']);
    }

    public function render()
    {
        return view('admin.location.state-edit');
    }
}
