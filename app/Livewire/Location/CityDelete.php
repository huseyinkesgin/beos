<?php

namespace App\Livewire\Location;

use App\Models\City;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class CityDelete extends Component
{

    use InteractsWithBanner;

    public $cityId;
    public $open = false;

    protected $listeners = ['openDeleteModal' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->cityId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $city = City::findOrFail($this->cityId);
        $city->delete(); // Soft delete işlemi

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['cityId', 'open']);
    }
    
    public function render()
    {
        return view('admin.location.city-delete');
    }
}
