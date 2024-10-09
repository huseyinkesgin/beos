<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\District;
use App\Models\State;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DistrictEdit extends Component
{
    use InteractsWithBanner;

    public $states;
    public $cities;
    public $districtId;
    public $state_id;
    public $city_id;
    public $name;
    public $isActive;
    public $note;
    public $open = false;

    protected $listeners = ['openEditModal' => 'loadDistrict'];

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
        $this->initializeStates();
        $this->resetCities();
    }

    public function openEditModal($id)
    {
        $this->loadDistrict($id);
        $this->open = true;
    }

    public function loadDistrict($id)
    {
        $district = District::findOrFail($id);
        $this->setDistrict($district);
        $this->loadCitiesByState($this->state_id);
        $this->open = true;
    }

    public function updatedStateId($value)
    {
        $this->loadCitiesByState($value);
        $this->city_id = null; // İl değiştiğinde ilçe seçimini sıfırla
    }

    public function save()
    {
        $this->validate();
        $this->updateDistrict();
        $this->dispatchEvents();
        $this->resetForm();
    }

    public function render()
    {
        return view('admin.location.district-edit');
    }

    /**
     * Initialize the states list.
     */
    private function initializeStates()
    {
        $this->states = State::active()->get();
    }

    /**
     * Load the cities based on the selected state ID.
     */
    private function loadCitiesByState($stateId)
    {
        $this->cities = City::where('state_id', $stateId)->get();
    }

    /**
     * Reset the cities collection.
     */
    private function resetCities()
    {
        $this->cities = collect();
    }

    /**
     * Set the attributes for the district.
     */
    private function setDistrict(District $district)
    {
        $this->districtId = $district->id;
        $this->state_id = $district->state_id;
        $this->city_id = $district->city_id;
        $this->name = $district->name;
        $this->isActive = $district->isActive;
        $this->note = $district->note;
    }

    /**
     * Update the district details in the database.
     */
    private function updateDistrict()
    {
        $district = District::findOrFail($this->districtId);
        $district->update([
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);
    }

    /**
     * Dispatch events after saving.
     */
    private function dispatchEvents()
    {
        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarıyla güncellendi!', type: 'success');
    }

    /**
     * Reset the form to its initial state.
     */
    private function resetForm()
    {
        $this->reset(['districtId', 'state_id', 'city_id', 'name', 'isActive', 'note', 'open']);
    }
}
