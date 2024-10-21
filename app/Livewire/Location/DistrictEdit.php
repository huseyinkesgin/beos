<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use App\Models\District;
use Livewire\Attributes\On;

class DistrictEdit extends Component
{
    public $state_id , $city_id, $name, $isActive = true, $note;
    public $states;
    public $cities = [];
    public $districtId;
    public $open = false;

    protected function rules()
    {
        return [
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255|unique:districts,name,' . $this->districtId,
            'isActive' => 'boolean',
            'note' => 'nullable|string',
        ];
    }

    public function mount()
    {
        $this->states = State::active()->get();

        // Eğer district düzenleme modundaysa mevcut state ve city bilgilerini yükleyelim
        if ($this->districtId) {
            $this->cities = City::where('state_id', $this->state_id)->get();
        }
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->loadDistrict($id);
        $this->open = true;
    }

    public function loadDistrict($id)
    {
        $district = District::findOrFail($id);
        $this->districtId = $district->id;
        $this->state_id = $district->state_id;
        $this->city_id = $district->city_id;
        $this->name = $district->name;
        $this->isActive = $district->isActive;
        $this->note = $district->note;

        // Seçili state'e göre şehirleri yükleyelim
        $this->cities = City::where('state_id', $this->state_id)->get();
        $this->open = true;
    }

    public function updatedStateId($value)
    {
        // State değiştirildiğinde, ilgili şehirleri yükleyelim
        $this->cities = City::where('state_id', $value)->get();
        $this->city_id = null; // Şehir seçimini sıfırlıyoruz
    }

    public function save()
    {
        $this->validate();

        $district = District::findOrFail($this->districtId);
        $district->update([
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('district-edited');
        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarıyla güncellendi!', type: 'success');
        $this->reset(['state_id', 'city_id', 'name', 'isActive', 'note', 'open']);
    }

    public function render()
    {
        return view('admin.location.district-edit');
    }
}
