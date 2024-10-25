<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use Livewire\Attributes\On;

class CityCreate extends Component
{

    public $state_id, $name, $isActive = true, $note;
    public $open = false;

    protected $rules = [
        'state_id' => 'required',
        'name' => 'required|string|max:255|unique:cities,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];


    #[On('openCreateCityModal')]
    public function openModal()
    {
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        City::create([
            'state_id' => $this->state_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('city-created');
        $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        $states = State::active()->get();
        return view('admin.location.city-create',[
            'states' => $states
        ]);
    }
}
