<?php

namespace App\Livewire\Location;

use App\Models\State;
use Livewire\Component;
use Livewire\Attributes\On;

class StateDelete extends Component
{

    public $stateId;
    public $open = false;

    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->stateId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $state = State::findOrFail($this->stateId);
        $state->delete();

        $this->dispatch('state-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['stateId', 'open']);
    }

    public function render()
    {
        return view('admin.location.state-delete');
    }
}
