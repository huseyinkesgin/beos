<?php

namespace App\Livewire\Shorts;

use App\Models\City;
use App\Models\State;
use App\Models\Address;
use Livewire\Component;
use App\Models\District;

class AddressModal extends Component
{

    public $modelType; // 'App\Models\Personnel' veya 'App\Models\Customer'
    public $modelId;
    public $address_line1;
    public $address_line2;
    public $state_id;
    public $city_id;
    public $district_id;
    public $postal_code;

    public $address_type = 'home';
    public $is_default = false;
    public $isActive = true;


    public $states;
    public $cities;
    public $districts = [];

    public $open = false;

    protected $listeners = ['openAddressModal' => 'openModal'];

    protected function rules()
    {
        return [
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'district_id' => 'required|exists:districts,id',
            'postal_code' => 'required|string|max:20',
            'address_type' => 'required|string',
            'is_default' => 'boolean',
            'isActive' => 'boolean',
        ];
    }

    public function openModal($modelType, $modelId)
    {

        $this->modelType = $modelType;
        $this->modelId = $modelId;
        $this->open = true;
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

    public function save()
    {
        $this->validate();


        $data= Address::create([
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'address_line1' => $this->address_line1,
            'address_line2' => $this->address_line2,
            'postal_code' => $this->postal_code,
            'address_type' => $this->address_type,
            'is_default' => $this->is_default,
            'isActive' => $this->isActive,
            'addressable_id' => $this->modelId,
            'addressable_type' => $this->modelType,
        ]);

        // dd($data);
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Adres başarıyla eklendi!', type: 'success');

        $this->reset(['address_line1', 'address_line2', 'state_id', 'city_id', 'district_id', 'postal_code', 'address_type', 'is_default', 'isActive']);


    }
    public function render()
    {
        $states = State::all();
        $cities = City::where('state_id', $this->state_id)->get();
        $districts = District::where('city_id', $this->city_id)->get();

        return view('admin.shorts.address-modal',compact('states', 'cities', 'districts'));
    }
}
