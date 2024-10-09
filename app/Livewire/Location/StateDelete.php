<?php

namespace App\Livewire\Location;

use App\Models\State;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class StateDelete extends Component
{

    use InteractsWithBanner;

    public $stateId;
    public $open = false;

    protected $listeners = ['openDeleteModal' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->stateId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $state = State::findOrFail($this->stateId);
        $state->delete(); // Soft delete işlemi

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['stateId', 'open']);
    }
    
    public function render()
    {
        return view('admin.location.state-delete');
    }
}
