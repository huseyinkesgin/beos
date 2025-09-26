<?php

namespace App\Livewire\Location;

use App\Livewire\BaseCreateComponent;
use App\Models\City;
use App\Models\State;
use Livewire\Attributes\On;

class CityCreate extends BaseCreateComponent
{

    public $state_id, $name ;

    protected $rules = [
        'state_id' => 'required',
        'name' => 'required|string|max:255|unique:cities,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    protected $messages = [
        'state_id.required' => 'Lütfen bir il seçin.',
        'name.required' => 'İlçe adı zorunludur.',
        'name.unique' => 'Bu ilçe adı zaten kayıtlı.',
        'name.max' => 'İlçe adı en fazla 255 karakter olabilir.',
    ];
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

    public function resetForm()
    {
        $this->reset('state_id', 'name',  'note');
        $this->resetValidation();
    }
}
