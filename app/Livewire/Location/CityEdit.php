<?php

namespace App\Livewire\Location;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use Livewire\Attributes\On;

class CityEdit extends Component
{

    public $state_id, $name, $isActive = true, $note;
    public $cityId;
    public $open = false;

    protected function rules()
    {
        return [
            'state_id' => 'required',
            'name' => 'required|string|max:255|unique:cities,name,' . $this->cityId,
            'isActive' => 'boolean',
            'note' => 'nullable|string',
        ];
    }
    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->loadCity($id);
        $this->open = true;
    }

    public function loadCity($id)
    {
        $city = City::findOrFail($id);

        $this->cityId = $city->id;
        $this->state_id = $city->state_id;
        $this->name = $city->name;
        $this->isActive = $city->isActive;
        $this->note = $city->note;
        $this->open = true;
    }

    public function save()
    {
        $this->validate();

        $city = City::findOrFail($this->cityId);
        $city->update([
            'state_id'=> $this->state_id,
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('city-edited');
        $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarıyla güncellendi!', type: 'success');
        $this->reset(['cityId', 'name', 'isActive', 'note', 'open']);
    }

    public function render()
    {
        $states = State::active()->get();
        return view('admin.location.city-edit', [
            'states' => $states
        ]);
    }
}
