<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\District;
use Livewire\Attributes\On;
use Laravel\Jetstream\InteractsWithBanner;

class DistrictDelete extends Component
{

    public $districtId;
    public $open = false;


    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->districtId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $district = District::findOrFail($this->districtId);
        $district->delete();


        $this->dispatch('district-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['districtId', 'open']);
    }

    public function render()
    {
        return view('admin.location.district-delete');
    }
}
