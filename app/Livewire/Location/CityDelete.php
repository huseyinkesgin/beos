<?php

namespace App\Livewire\Location;

use App\Models\City;
use Livewire\Component;
use Livewire\Attributes\On;

class CityDelete extends Component
{

    public $cityId;
    public $open = false;


    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->cityId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $city = City::findOrFail($this->cityId);
        $city->delete();

        $this->dispatch('city-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['cityId', 'open']);
    }

    public function render()
    {
        return view('admin.location.city-delete');
    }
}
