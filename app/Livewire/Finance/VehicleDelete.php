<?php

namespace App\Livewire\Finance;

use App\Models\Vehicle;
use Livewire\Component;
use Livewire\Attributes\On;

class VehicleDelete extends Component
{
    public $vehicleId;
    public $open = false;


    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->vehicleId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $vehicle = Vehicle::findOrFail($this->vehicleId);
        $vehicle->delete();

        $this->dispatch('vehicle-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'Araba başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['vehicleId', 'open']);
    }

    public function render()
    {
        return view('admin.finance.vehicle-delete');
    }
}
