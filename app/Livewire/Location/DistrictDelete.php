<?php

namespace App\Livewire\Location;

use App\Models\District;
use Livewire\Component;
use Laravel\Jetstream\InteractsWithBanner;

class DistrictDelete extends Component
{

    use InteractsWithBanner;

    public $districtId;
    public $open = false;

    protected $listeners = ['openDeleteModal' => 'confirmDelete'];

    public function confirmDelete($id)
    {
        $this->districtId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $district = District::findOrFail($this->districtId);
        $district->delete(); // Soft delete işlemi

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['districtId', 'open']);
    }

    public function render()
    {
        return view('admin.location.district-delete');
    }
}