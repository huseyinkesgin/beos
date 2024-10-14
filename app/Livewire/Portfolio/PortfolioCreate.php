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


    // ~~~~~~~~~~ PORTFOLİO DATABASE ~~~~~~~~~ //
    public $portfolio_no,  $state_id, $city_id, $district_id, $category_id, $type_id,  $lot, $parcel, $price, $status ="Satılık", $deposit, $property_no, $isCredit = false, $deed_type, $isSwap = false, $description,$advisor,$partner_customer_id,$owner_customer_id,$isActive = true ,$note;

    // ~~~~~~~~~~~~ ORTAK DATABASE ~~~~~~~~~~~ //
    public $area_m2,$portfolio_id, $floor_level, $heating_type,$building_year, $usage_status, $zoning_status,$similar,$height_limit;


    // ~~~~~~~~~~~ İŞYERİ DATABASE ~~~~~~~~~~~ //
    public $open_area, $closed_area, $business_area, $office_area, $floor_count,  $electricity_power,  $building_condition,
    $ground_analysis, $height;

    // ~~~~~~~~~~~~ KONUT DATABASE ~~~~~~~~~~~ //
    public $room_count,  $total_floors,  $bathroom_count, $isFurnished, $isBalcon, $isElevator, $parking;

    // ~~~~~~~~~~~ İL - İLÇE- BÖLGE ~~~~~~~~~~ //
    public $states;
    public $cities;
    public $districts = [];


   // ~~~~~~~~ PARTNER VE MAL SAHİBİ ~~~~~~~~ //
    public $has_partner = false;
    public $partnerList;
    public $ownerList;

    // ~~~~~~~~~~ KATEGORİ VE TİPLER ~~~~~~~~~ //
    public $categories;
    public $types = [];
    public $form_path;

   //  ARSA, İŞTERİ VE KONUT DATABASE ULAŞMA  //
    public $landCategoryId;
    public $businessCategoryId;
    public $homeCategoryId;


    // ~~~~~~~~~~~~~~~~MODAL İÇİN~~~~~~~~~~~~~~~~~~~~~~~ //
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

     // --------------------- DİNAMİK KATEGORİ VE TİP SEÇİMİ --------------------- //
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

    // ~~~~~~~~~~~ PORTFOLIO KAYIT ~~~~~~~~~~~ //

    public function save()
    {
        $portfolio = $this->createPortfolio();
        if ($this->category_id == $this->landCategoryId) {
            $this->createLand($portfolio);
        } elseif ($this->category_id == $this->businessCategoryId) {
            $this->createBusiness($portfolio);
        } elseif ($this->category_id == $this->homeCategoryId) {
            $this->createHome($portfolio);
        }

        $this->dispatch('refreshTable');

        $this->dispatch('notify', title: 'Başarılı', text: 'Portföy başarıyla kayıt edildi!', type: 'success');
    }

    // ~~~~~~~~~~~ PORTFOLIO OLUŞTURMA ~~~~~~~~~~~ //
    protected function createPortfolio()
    {
        $validatedData = $this->validate([
            'state_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'portfolio_no' => 'required|string',
            'lot' => 'required|numeric',
            'parcel' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'deposit' => 'nullable|string',
            'additional_fees' => 'nullable|string',
            'property_no' => 'required|numeric',
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

        return Portfolio::create($validatedData);
    }


    // ~~~~~~~~~~~ İŞYERİ OLUŞTURMA ~~~~~~~~~~~ //
    protected function createBusiness($portfolio)
    {
        if ($this->category_id == $this->businessCategoryId) {
            $businessData = $this->validate([
                'area_m2' => 'required|numeric',
                'open_area' => 'required|numeric',
                'closed_area' => 'required|numeric',
                'business_area' => 'required|numeric',
                'office_area' => 'nullable|numeric',
                'floor_count' => 'nullable|integer',
                'floor_level' => 'nullable|integer',
                'electricity_power' => 'nullable|numeric',
                'building_year' => 'nullable|integer',
                'heating_type' => 'nullable|string',
                'building_condition' => 'nullable|string',
                'usage_status' => 'required|string',
                'ground_analysis' => 'nullable|string',
                'height' => 'required|numeric',
            ]);

            $businessData['portfolio_id'] = $portfolio->id;

            Business::create($businessData);
            $this->dispatch('closeModal');
        }
    }

    // ~~~~~~~~~~~ KONUT OLUŞTURMA ~~~~~~~~~~~ //
    protected function createHome($portfolio)
    {
        if ($this->category_id == $this->homeCategoryId) {
            $homeData = $this->validate([
                'area_m2' => 'required|numeric',
                'room_count' => 'required|integer',
                'building_years' => 'nullable|integer',
                'floor_level' => 'nullable|integer',
                'total_floors' => 'nullable|integer',
                'heating_type' => 'nullable|string',
                'bathroom_count' => 'nullable|integer',
                'isFurnished' => 'boolean',
                'isBalcon' => 'boolean',
                'isElevator' => 'boolean',
                'parking' => 'nullable|string',
                'usage_status' => 'nullable|string',
            ]);

            $homeData['portfolio_id'] = $portfolio->id;

            Home::create($homeData);
            $this->dispatch('closeModal');
        }
    }

    

    public function render()
    {

        return view('admin.portfolio.portfolio-create', [
            //
        ]);
    }
}
