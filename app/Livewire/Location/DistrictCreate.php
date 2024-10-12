<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use App\Models\District;
use Illuminate\Support\Str;


class DistrictCreate extends Component
{


    public $states;
    public $cities = [];
    public $selectedState;


    public $state_id;
    public $city_id;
    public $name;
    public $isActive = true;
    public $note;
    public $open = false;
    public $filteredCities = [];

    protected $rules = [
        'state_id' => 'required',
        'city_id' => 'required',
        'name' => 'required|string|max:255|unique:districts,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function openModal()
    {
        $this->open = true;
    }

    public function mount(District $district)
    {
        $this->states = State::active()->get();


    }

    public function updatedSelectedState($value)
    {
        $this->state_id = $value;
        $this->cities = City::where('state_id', $value)->get();
        $this->city_id = null;

    }



    public function save()
    {
        $this->validate();

        District::create([
            'state_id' => $this->selectedState,
            'city_id' => $this->city_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarıyla kayıt edildi!', type: 'success');
        $this->reset(['selectedState', 'city_id', 'name', 'isActive', 'note', 'open']);
    }


    public function render()
    {
        $states = State::active()->get();
        return view('admin.location.district-create',[

            'states' => $states
        ]);
    }
}
