<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use App\Models\District;
use Illuminate\Support\Str;
use Livewire\Attributes\On;


class DistrictCreate extends Component
{

    public $state_id , $city_id, $name, $isActive = true, $note ;
    public $states;
    public $cities = [];



    public $open = false;

    protected $rules = [
        'state_id' => 'required',
        'city_id' => 'required',
        'name' => 'required|string|max:255|unique:districts,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    #[On('openCreateModal')]
    public function openModal()
    {
        $this->open = true;
        $this->reset('state_id','city_id','name');

    }

    public function mount(District $district)
    {
        $this->states = State::active()->get();
    }

    public function updatedStateId($value)
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

        $this->dispatch('district-created');
        $this->dispatch('notify', title: 'Başarılı', text: 'Bölge başarıyla kayıt edildi!', type: 'success');
        $this->reset(['selectedState', 'city_id', 'name', 'isActive', 'note', 'open']);
    }


    public function render()
    {
        return view('admin.location.district-create',[

        ]);
    }
}
