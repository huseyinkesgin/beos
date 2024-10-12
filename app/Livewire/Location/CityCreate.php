<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\State;
use Illuminate\Support\Str;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class CityCreate extends Component
{

    public $state_id;
    public $name;
    public $isActive = true;
    public $note;
    public $open = false;

    protected $rules = [
        'state_id' => 'required',
        'name' => 'required|string|max:255|unique:cities,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    protected $listeners = ['openCreateModal' => 'openModal'];

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

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
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
