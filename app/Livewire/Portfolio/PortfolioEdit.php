<?php

namespace App\Livewire\Portfolio;

use App\Models\City;
use App\Models\Type;
use App\Models\State;
use Livewire\Component;
use App\Models\Category;
use App\Models\Customer;
use App\Models\District;
use App\Models\Personnel;
use App\Models\Portfolio;
use Illuminate\Http\File;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class PortfolioEdit extends Component
{
    use WithFileUploads;

    // Step Navigation Properties
    public int $currentStep = 1, $totalSteps = 5;

    // General Portfolio Properties
    public int $portfolio_id, $state_id, $city_id, $district_id, $category_id, $type_id;
    public string $portfolio_no, $status, $property_no;
    public $deposit, $deed_type, $description, $advisor, $note, $form_path;
    public $price, $additional_fees, $area_m2;
    public $isCredit, $isSwap, $isActive = true, $open = false;
    public $partner_customer_id, $owner_customer_id;
    public $lot, $parcel;
    public $has_partner;

    // Land-specific Properties
    public string $zoning_status, $height_limit, $similar;
    // Business-specific Properties
    public  $open_area, $closed_area, $business_area, $office_area, $height, $electricity_power;
    public  $floor_count, $building_year;
    public  $floor_level, $heating_type, $building_condition, $usage_status, $isCrane, $crane_description;
    public $ground_analysis = false;


    // Home-specific Properties
    public int $room_count, $total_floors;
    public bool $isFurnished = false, $isBalcon = false, $isElevator = false;

    // Dropdown Options
    public $states, $cities, $districts, $categories, $types, $partnerList, $ownerList, $advisorsList;

    // Category ID Constants
    public int $landCategoryId, $businessCategoryId, $homeCategoryId;


    #[On('openEditModal')]
    public function openModal($id)
    {
        
   
       $this->portfolio_id = $id;
        $this->loadPortfolioData();
        $this->open = true;
    }

    public function mount()
    {
        $this->states = State::active()->get();
        $this->categories = Category::active()->get();
        $this->partnerList = Customer::partnerList()->get();
        $this->ownerList = Customer::ownerList()->get();
        // Danışman listesini çekiyoruz
        $this->advisorsList = Personnel::advisors()->get();

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

    public function nextStep()
    {
        $this->validateCurrentStep();
        $this->currentStep++;
        // Log ekleyerek kontrol edelim
        info('İleri adım tıklandı, currentStep: ' . $this->currentStep);
    }

    // Geri adım
    public function previousStep()
    {
        $this->currentStep--;
    }

    public function loadPortfolioData()
    {
        // Kategoriye özgü ilişkili modelleri yükleyin
        $portfolio = Portfolio::with(['category', 'type', 'state', 'city', 'district', 'owner', 'partner', 'land', 'business', 'home'])
            ->findOrFail($this->portfolio_id);

        // Genel alanları doldurun
        $this->portfolio_no = $portfolio->portfolio_no;
        $this->state_id = $portfolio->state_id;
        $this->city_id = $portfolio->city_id;
        $this->district_id = $portfolio->district_id;
        $this->category_id = $portfolio->category_id;
        $this->type_id = $portfolio->type_id;
        $this->lot = $portfolio->lot;
        $this->parcel = $portfolio->parcel;
        $this->price = $portfolio->price;
        $this->status = $portfolio->status;
        $this->deposit = $portfolio->deposit;
        $this->property_no = $portfolio->property_no;
        $this->isCredit = $portfolio->isCredit;
        $this->deed_type = $portfolio->deed_type;
        $this->isSwap = $portfolio->isSwap;
        $this->description = $portfolio->description;
        $this->advisor = $portfolio->advisor;
        $this->partner_customer_id = $portfolio->partner_customer_id;
        $this->owner_customer_id = $portfolio->owner_customer_id;
        $this->isActive = $portfolio->isActive;
        $this->note = $portfolio->note;
        $this->additional_fees = $portfolio->additional_fees;
        $this->area_m2 = $portfolio->area_m2;

        // Kategoriye özel alanları doldurun
        if ($portfolio->category_id == $this->landCategoryId && $portfolio->land) {
            $this->zoning_status = $portfolio->land->zoning_status;
            $this->height_limit = $portfolio->land->height_limit;
            $this->similar = $portfolio->land->similar;
        } elseif ($portfolio->category_id == $this->businessCategoryId && $portfolio->business) {
            $this->open_area = $portfolio->business->open_area;
            $this->closed_area = $portfolio->business->closed_area;
            $this->business_area = $portfolio->business->business_area;
            $this->office_area = $portfolio->business->office_area;
            $this->height = $portfolio->business->height;
            $this->floor_count = $portfolio->business->floor_count;
            $this->floor_level = $portfolio->business->floor_level;
            $this->electricity_power = $portfolio->business->electricity_power;
            $this->building_year = $portfolio->business->building_year;
            $this->heating_type = $portfolio->business->heating_type;
            $this->building_condition = $portfolio->business->building_condition;
            $this->usage_status = $portfolio->business->usage_status;
            $this->ground_analysis = $portfolio->business->ground_analysis;
            $this->isCrane = $portfolio->business->isCrane ?? false;
            $this->crane_description = $portfolio->business->crane_description;
            $this->zoning_status = $portfolio->business->zoning_status ?? '';
        } elseif ($portfolio->category_id == $this->homeCategoryId && $portfolio->home) {
            $this->room_count = $portfolio->home->room_count;
            $this->total_floors = $portfolio->home->total_floors;
            $this->floor_level = $portfolio->home->floor_level;
            $this->isFurnished = $portfolio->home->isFurnished;
            $this->isBalcon = $portfolio->home->isBalcon;
            $this->isElevator = $portfolio->home->isElevator;
        }

        // Form yolunu ayarla
        $this->form_path = $portfolio->type ? $portfolio->type->form_path : null;

        $this->loadDropdownData();
    }


    public function loadDropdownData()
    {
        // İlişkili verileri çek
        $this->states = State::all();
        $this->categories = Category::all();
        $this->partnerList = Customer::partnerList()->get();
        $this->ownerList = Customer::ownerList()->get();
        $this->advisorsList = Personnel::advisors()->get();
        $this->cities = City::where('state_id', $this->state_id)->get();
        $this->districts = District::where('city_id', $this->city_id)->get();
        $this->types = Type::where('category_id', $this->category_id)->get();
    }

    protected function getValidationRules()
    {
        $rules = [
            'portfolio_no' => 'required|string|unique:portfolios,portfolio_no,' . $this->portfolio_id,
            'state_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'lot' => 'required|numeric',
            'parcel' => 'required|numeric',
        ];

        if ($this->category_id == $this->landCategoryId) {
            $rules = array_merge($rules, [
                'zoning_status' => 'required|string',
                'similar' => 'nullable|string',
                'height_limit' => 'nullable|string',
            ]);
        } elseif ($this->category_id == $this->businessCategoryId) {
            $rules = array_merge($rules, [
                'open_area' => 'required|numeric',
                'closed_area' => 'required|numeric',
                'business_area' => 'required|numeric',
                'office_area' => 'required|numeric',
                'height' => 'nullable|numeric',
                'floor_count' => 'nullable|numeric',
                'floor_level' => 'nullable|string',
                'electricity_power' => 'nullable|numeric',
                'building_year' => 'nullable|numeric',
                'heating_type' => 'nullable|string',
                'building_condition' => 'nullable|string',
                'usage_status' => 'nullable|string',
                'ground_analysis' => 'boolean',
                'zoning_status' => 'required|string'
            ]);
        } elseif ($this->category_id == $this->homeCategoryId) {
            $rules = array_merge($rules, [
                'room_count' => 'required|integer',
                'total_floors' => 'nullable|integer',
                'isFurnished' => 'boolean',
                'isBalcon' => 'boolean',
                'isElevator' => 'boolean',
            ]);
        }

        return $rules;
    }

    protected function validateCurrentStep()
    {
        // 1. Adım: Lokasyon ve Temel Bilgiler
        if ($this->currentStep == 1) {
            $this->validate([
                'state_id' => 'required',
                'city_id' => 'required',
                'district_id' => 'required',
                'category_id' => 'required',
                'type_id' => 'required',
                'status' => 'required|string',
                'price' => 'required|numeric',
                'lot' => 'required|numeric',
                'parcel' => 'required|numeric',
            ]);
        }
        // 2. Adım: Arsa, İş Yeri ve Konut Bilgileri
        elseif ($this->currentStep == 2) {
            if ($this->category_id == $this->landCategoryId) {
                $this->validate([
                    'zoning_status' => 'required|string',
                    'height_limit' => 'nullable|string',
                    'similar' => 'nullable|string',
                ]);
            } elseif ($this->category_id == $this->businessCategoryId) {
                $this->validate([
                    'open_area' => 'required|numeric',
                    'closed_area' => 'required|numeric',
                    'business_area' => 'required|numeric',
                    'office_area' => 'required|numeric',
                    'zoning_status' => 'required|string',
                    'height' => 'nullable|numeric',
                    'floor_count' => 'nullable|numeric',
                    'electricity_power' => 'nullable|numeric',
                    'building_year' => 'nullable|numeric',
                    'heating_type' => 'nullable|string',
                    'usage_status' => 'nullable|string',
                    'ground_analysis' => 'boolean',
                ]);
            } elseif ($this->category_id == $this->homeCategoryId) {
                $this->validate([
                    'room_count' => 'required|integer',
                    'total_floors' => 'nullable|integer',
                    'floor_level' => 'nullable|integer',
                    'isFurnished' => 'boolean',
                    'isBalcon' => 'boolean',
                    'isElevator' => 'boolean',
                ]);
            }
        }
        // 3. Adım: Finansal ve İdari Bilgiler
        elseif ($this->currentStep == 3) {
            $this->validate([
                'lot' => 'required|numeric',
                'parcel' => 'required|numeric',
                'portfolio_no' => 'required',
                'price' => 'required|string',
                'deed_type' => 'nullable|string',
                'isCredit' => 'nullable|string',
                'isSwap' => 'nullable|string',
                'property_no' => 'required',
                'deposit' => $this->status == 'Kiralık' ? 'nullable|string' : 'nullable',
            ]);
        }
        // 4. Adım: Müşteri ve Ortak Bilgileri
        elseif ($this->currentStep == 4) {
            $this->validate([
                'owner_customer_id' => 'required',
                'partner_customer_id' => 'nullable',
                'advisor' => 'nullable|string',
                'note' => 'nullable|string',
            ]);
        }
        // 5. Adım: Ek Bilgiler (eğer varsa)
        elseif ($this->currentStep == 5) {
            $this->validate([
                'description' => 'nullable|string',
                'isActive' => 'required|boolean',
            ]);
        }
    }


    public function updatePortfolio()
    {
        $this->validate([
            'portfolio_no' => 'required|string|unique:portfolios,portfolio_no,' . $this->portfolio_id,
            'state_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'lot' => 'required|numeric',
            'parcel' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $portfolio = Portfolio::findOrFail($this->portfolio_id);

        // Portföy ana bilgilerini güncelle
        $portfolio->update([
            'portfolio_no' => $this->portfolio_no,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'lot' => $this->lot,
            'parcel' => $this->parcel,
            'price' => $this->price,
            'status' => $this->status,
            'deposit' => $this->deposit,
            'property_no' => $this->property_no,
            'isCredit' => $this->isCredit,
            'deed_type' => $this->deed_type,
            'isSwap' => $this->isSwap,
            'description' => $this->description,
            'advisor' => $this->advisor,
            'partner_customer_id' => $this->partner_customer_id,
            'owner_customer_id' => $this->owner_customer_id,
            'isActive' => $this->isActive,
            'note' => $this->note,
            'additional_fees' => $this->additional_fees,
            'area_m2' => $this->area_m2,
        ]);

        // Kategoriye özgü model güncellemeleri
        if ($this->category_id == $this->landCategoryId) {
            // Arsa kategorisi için Land modelini güncelle
            $portfolio->land()->updateOrCreate(
                ['portfolio_id' => $this->portfolio_id],
                [
                    'zoning_status' => $this->zoning_status,
                    'similar' => $this->similar,
                    'height_limit' => $this->height_limit,
                ]
            );
        } elseif ($this->category_id == $this->businessCategoryId) {
            // İşyeri kategorisi için Business modelini güncelle
            $portfolio->business()->updateOrCreate(
                ['portfolio_id' => $this->portfolio_id],
                [
                    'zoning_status' => $this->zoning_status,
                    'open_area' => $this->open_area,
                    'closed_area' => $this->closed_area,
                    'business_area' => $this->business_area,
                    'office_area' => $this->office_area,
                    'height' => $this->height,
                    'floor_count' => $this->floor_count,
                    'floor_level' => $this->floor_level,
                    'electricity_power' => $this->electricity_power,
                    'building_year' => $this->building_year,
                    'heating_type' => $this->heating_type,
                    'building_condition' => $this->building_condition,
                    'usage_status' => $this->usage_status,
                    'ground_analysis' => $this->ground_analysis,
                ]
            );
        } elseif ($this->category_id == $this->homeCategoryId) {
            // Konut kategorisi için Home modelini güncelle
            $portfolio->home()->updateOrCreate(
                ['portfolio_id' => $this->portfolio_id],
                [
                    'room_count' => $this->room_count,
                    'floor_level' => $this->floor_level,
                    'total_floors' => $this->total_floors,
                    'isFurnished' => $this->isFurnished,
                    'isBalcon' => $this->isBalcon,
                    'isElevator' => $this->isElevator,
                ]
            );
        }

        $this->dispatch('portfolio-edited');
        $this->dispatch('notify', title: 'Başarılı!', text: 'Portföy başarıyla kaydedildi.', type: 'success');
        $this->reset('open');
        $this->reset([
            'portfolio_id', 'state_id', 'city_id', 'district_id', 'category_id', 'type_id',
            'lot', 'parcel', 'price', 'status', 'deposit', 'property_no', 'isCredit', 'deed_type',
            'isSwap', 'description', 'advisor', 'partner_customer_id', 'owner_customer_id', 'isActive',
            'note', 'additional_fees', 'area_m2', 'zoning_status', 'height_limit', 'similar',
            'open_area', 'closed_area', 'business_area', 'office_area', 'height', 'floor_count', 
            'floor_level', 'electricity_power', 'building_year', 'heating_type', 'building_condition', 
            'usage_status', 'ground_analysis', 'room_count', 'total_floors', 'isFurnished', 'isBalcon', 
            'isElevator', 'isCrane', 'crane_description'
        ]);
        
    }


    public function render()
    {
        return view('admin.portfolio.portfolio-edit', [
            'states' => $this->states,
            'cities' => $this->cities,
            'districts' => $this->districts,
            'categories' => $this->categories,
            'types' => $this->types,
            'partnerList' => $this->partnerList,
            'ownerList' => $this->ownerList,
            'advisorsList' => $this->advisorsList,
        ]);
    }
}
