<?php

namespace App\Livewire\Portfolio;

use App\Models\City;
use App\Models\Home;
use App\Models\Land;
use App\Models\Type;
use App\Models\State;
use Livewire\Component;
use App\Models\Business;
use App\Models\Category;
use App\Models\Customer;
use App\Models\District;
use App\Models\Portfolio;

class PortfolioCreate extends Component
{
    public $portfolio_no;
    public $portfolio_id;

    public $lot;

    public $parcel;

    public $price;

    public $property_no;
    public $area_m2;
public $zoning_status;
public $similar;
public $height_limit;

    public $isCredit = false;

    public $deed_type;

    public $isSwap = false;

    public $description;

    public $advisor;

    public $partner_customer_id;

    public $owner_customer_id;

    public $note;

    public $status = 'Satılık';

    public $deposit;

    public $additional_fees;

    public $states;

    public $cities;

    public $districts = [];

    public $state_id;

    public $city_id;

    public $district_id;

    public $has_partner = false;

    public $partnerList;

    public $ownerList;

    public $categories;

    public $types = [];

    public $category_id;

    public $type_id;

    public $form_path;

    public $isActive = true;
     // Kategori ID'leri
     public $landCategoryId;
     public $businessCategoryId;
     public $homeCategoryId;

    public $open = false;

    protected $listeners = ['openCreateModal' => 'openModal'];

    public function openModal()
    {

        $this->open = true; // Open the modal

    }

    public function mount()
    {
        $this->states = State::active()->get();
        $this->categories = Category::active()->get();
        $this->partnerList = Customer::partnerList()->get();
        $this->ownerList = Customer::ownerList()->get();

        // Kategori ID'leri burada tanımlayın
        $this->landCategoryId = Category::where('name', 'Arsa')->first()->id ?? null;
        $this->businessCategoryId = Category::where('name', 'İşyeri')->first()->id ?? null;
        $this->homeCategoryId = Category::where('name', 'Konut')->first()->id ?? null;
    }

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

    public function updatedCategoryId($value)
    {
        $this->types = Type::where('category_id', $value)->get(); // Kategoriye göre typeları al
        $this->type_id = null;
        $this->form_path = null;
    }

    public function updatedTypeId($value)
    {
        $type = Type::find($value);
        if ($type) {
            $this->form_path = $type->form_path;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'state_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'portfolio_no' => 'nullable|string',
            'lot' => 'required|string',
            'parcel' => 'required|string',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'deposit' => 'nullable|numeric|min:0',
            'additional_fees' => 'nullable|string',
            'property_no' => 'nullable|string',
            'isCredit' => 'boolean',
            'deed_type' => 'required|string',
            'isSwap' => 'boolean',
            'description' => 'nullable|string',
            'advisor' => 'nullable|string',
            'partner_customer_id' => 'nullable|exists:customers,id',
            'owner_customer_id' => 'nullable|exists:customers,id',
            'isActive' => 'boolean',
            'note' => 'nullable|string',
        ]);


        $portfolio = Portfolio::create($validatedData);

        if ($this->category_id == $this->landCategoryId) {
            $landData = $this->validate([
                'area_m2' => 'required|string',
                'zoning_status' => 'required|string',
                'similar' => 'nullable|string',
                'height_limit' => 'nullable|string',
            ]);
            $landData['portfolio_id'] = $portfolio->uuid;


            Land::create($landData);
        }

        if ($this->category_id == $this->businessCategoryId) {
            $businessData = $this->validate([
                'area_m2' => 'nullable|numeric|min:0',
                'open_area' => 'nullable|numeric|min:0',
                'closed_area' => 'nullable|numeric|min:0',
                'business_area' => 'nullable|numeric|min:0',
                'office_area' => 'nullable|numeric|min:0',
                'floor_count' => 'nullable|integer|min:0',
                'floor_level' => 'nullable|integer|min:0',
                'electricity_power' => 'nullable|numeric|min:0',
                'building_year' => 'nullable|integer|min:1800|max:'.date('Y'),
                'heating_type' => 'nullable|string',
                'building_condition' => 'nullable|string',
                'usage_status' => 'nullable|string',
                'ground_analysis' => 'boolean',
                'height' => 'nullable|string',
            ]);
            $businessData['portfolio_id'] = $portfolio->uuid;
            Business::create($businessData);
        }

        if ($this->category_id == $this->homeCategoryId) {
            $homeData = $this->validate([
                'area_m2' => 'required|numeric|min:0',
                'room_count' => 'required|string',
                'building_years' => 'nullable|string',
                'floor_level' => 'required|integer|min:0',
                'total_floors' => 'required|integer|min:0',
                'heating_type' => 'nullable|string',
                'bathroom_count' => 'nullable|string',
                'isFurnished' => 'boolean',
                'isBalcon' => 'boolean',
                'isElevator' => 'boolean',
                'parking' => 'nullable|string',
                'usage_status' => 'nullable|string',
            ]);
            $homeData['portfolio_id'] = $portfolio->uuid;
            Home::create($homeData);
        }


        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Portföy başarıyla kayıt edildi!', type: 'success');
        $this->reset();
    }

    public function render()
    {

        return view('admin.portfolio.portfolio-create', [
            //
        ]);
    }
}
