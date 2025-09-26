<?php

namespace App\Livewire\Location;

use App\Livewire\BaseCreateComponent;
use App\Models\State;

class StateCreate extends BaseCreateComponent
{
    public $name;
 

    protected $rules = [
        'name' => 'required|string|max:255|unique:states,name,',
        'isActive' => 'boolean',
        'note' => 'nullable|string',
    ];

    protected $messages = [
        'name.required' => 'İl adı zorunludur.',
        'name.unique' => 'Bu il adı zaten kayıtlı.',
        'name.max' => 'İl adı en fazla 255 karakter olabilir.',
    ];

   

    public function save()
    {
        $this->validate();

        State::create([
            'name' => $this->name,
            'isActive' => $this->isActive,
            'note' => $this->note,
        ]);

        $this->dispatch('state-created');
        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }


    public function render()
    {
        return view('admin.location.state-create');
    }

    public function resetForm()
    {
        $this->reset('name',  'note');
        $this->resetValidation();
    }
}
