<?php

namespace App\Livewire\Location;

use App\Models\City;
use Livewire\Component;
use Livewire\Attributes\On;

class CityAddModal extends Component
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

    public function messages()
    {
        return [
            'state_id.required' => 'Lütfen bir il seçin.',
            'name.required' => 'İlçe adı gereklidir.',
            'name.unique' => 'Bu isimde zaten bir ilçe var.',
            'name.max' => 'İlçe adı en fazla 255 karakter olabilir.',
            'isActive.boolean' => 'Aktiflik değeri geçersiz.',
            'note.string' => 'Not metin olmalıdır.',
        ];
    }
    #[On('open-city-modal')]
    public function openCityModal($state_id)
    {
        // Yeni ilçe ekleme için
        $this->reset(['cityId', 'name', 'note']);
        $this->state_id = $state_id;
        $this->isActive = true;
        $this->open = true;
    }

    #[On('edit-city-modal')]
    public function editCityModal($id)
    {
        // Mevcut ilçe düzenleme için
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
    }

    public function save()
    {
        $this->validate();

        if ($this->cityId) {
            // Mevcut ilçeyi güncelle
            $city = City::findOrFail($this->cityId);
            $city->update([
                'state_id'=> $this->state_id,
                'name' => $this->name,
                'isActive' => $this->isActive,
                'note' => $this->note,
            ]);
            
            $this->dispatch('city-edited');
            $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarıyla güncellendi!', type: 'success');
        } else {
            // Yeni ilçe ekle
            City::create([
                'state_id'=> $this->state_id,
                'name' => $this->name,
                'isActive' => $this->isActive,
                'note' => $this->note,
            ]);
            
            $this->dispatch('city-added');
            $this->dispatch('notify', title: 'Başarılı', text: 'İlçe başarıyla eklendi!', type: 'success');
        }

        $this->reset(['cityId', 'name', 'isActive', 'note', 'open']);
    }

    public function render()
    {
        $states = \App\Models\State::where('isActive', true)->get();
        
        return view('admin.location.city-add-modal', [
            'states' => $states
        ]);
    }
}
