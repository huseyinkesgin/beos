<?php

namespace App\Livewire\People;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use App\Models\District;
use App\Models\Personnel;

class PersonnelCreate extends Component
{

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $job_title;
    public $hire_date;
    public $termination_date;
    public $isActive;

     // Adres Alanları
     public $address_line1;
     public $address_line2;
     public $state_id;
     public $city_id;
     public $district_id;
     public $postal_code;
     public $address_type = 'home';
     public $is_default = false;


     public $states;
     public $cities;
     public $districts = [];


    public $open = false;

    protected $listeners = ['openCreateModal' => 'openModal'];

    protected $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|string',
        'phone' => 'required|string',
        'job_title' => 'required|string',
        'hire_date' => 'required|string',
        'termination_date' => 'nullable|string',
        'isActive' => 'boolean',

        'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'postal_code' => 'nullable|string|max:20',
            'address_type' => 'nullable|string',
            'is_default' => 'boolean',
    ];

    public function openModal()
    {
        $this->resetForm(); // Formu temizle
        $this->open = true; // Modal'ı aç
    }

    public function mount()
    {
        $this->states = State::active()->get();

    }

     // ~~~~~~~ DİNAMİK İL - İLÇE SEÇİMİ ~~~~~~ //
     public function updatedStateId($value)
     {
         $this->cities = City::where('state_id', $value)->get();
         $this->city_id = null;
         $this->district_id = null;
     }

     public function updatedCityId($value)
     {
         $this->districts = District::where('city_id', $value)->get();
         $this->district_id = null;
     }

    public function resetForm()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->email = null;
        $this->phone = null;
        $this->job_title = null;
        $this->hire_date = null;
        $this->termination_date = null;
        $this->isActive = true;
    }

    public function save()
    {
        $this->validate();

        $personnel= Personnel::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'job_title' => $this->job_title,
            'hire_date' => $this->hire_date,
            'termination_date' => $this->termination_date,
            'isActive' => $this->isActive,
        ]);

        

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Personel başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }



    public function render()
    {
        $states = State::all();
        $cities = City::where('state_id', $this->state_id)->get();
        $districts = District::where('city_id', $this->city_id)->get();

        return view('admin.people.personnel-create', compact('states', 'cities', 'districts'));
    }
}
