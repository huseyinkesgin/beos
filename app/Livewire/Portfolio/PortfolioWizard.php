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
use App\Models\Personnel;
use App\Models\Portfolio;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\PortfolioMedia;

class PortfolioWizard extends Component
{

    use WithFileUploads;

    public $currentStep = 1; // Başlangıç adımı

    public $totalSteps = 5; // Toplam adım sayısı



    public $satellite_image, $feature_image, $e_imar_image, $city_image, $slope_image;


    // ~~~~~~~~~~ PORTFOLİO DATABASE ~~~~~~~~~ //
    public $portfolio_no;

    public $state_id;

    public $city_id;

    public $district_id;

    public $category_id;

    public $type_id;

    public $lot;

    public $parcel;

    public $price;

    public $status = 'Satılık';

    public $deposit;

    public $property_no;

    public $isCredit;

    public $deed_type;

    public $isSwap;

    public $description;

    public $advisor;

    public $partner_customer_id;

    public $owner_customer_id;

    public $isActive = true;

    public $note;

    public $additional_fees;

    // ~~~~~~~~~~~~ ORTAK DATABASE ~~~~~~~~~~~ //
    public $area_m2;

    public $portfolio_id;

    public $floor_level;

    public $heating_type;

    public $building_year;

    public $usage_status;

    public $zoning_status;

    public $similar;

    public $height_limit;

    // ~~~~~~~~~~~ İŞYERİ DATABASE ~~~~~~~~~~~ //
    public $open_area;

    public $closed_area;

    public $business_area;

    public $office_area;

    public $floor_count;

    public $electricity_power;

    public $building_condition;

    public $ground_analysis;

    public $height;

    // ~~~~~~~~~~~~ KONUT DATABASE ~~~~~~~~~~~ //
    public $room_count;

    public $total_floors;

    public $bathroom_count;

    public $isFurnished;

    public $isBalcon;

    public $isElevator;

    public $parking;

    // ~~~~~~~~~~~ İL - İLÇE- BÖLGE ~~~~~~~~~~ //
    public $states;

    public $cities;

    public $districts;

    // ~~~~~~~~ PARTNER VE MAL SAHİBİ ~~~~~~~~ //
    public $has_partner = false;

    public $partnerList;

    public $ownerList;
    public $advisorsList;

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


    #[On('openWizardModal')]
    public function openModal()
    {
        $this->open = true; // Modalı aç
        $this->currentStep = 1; // Adımları sıfırla
    }

    #[On('state-created')]
    #[On('city-created')]
    #[On('district-created')]
    #[On('customer-created')]
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

     // Resimleri kaydetme işlemi
     private function storeImage($portfolioId, $image, $type)
     {
         if ($image) {
            $path = $image->storeAs("portfolios/{$this->portfolio_no}", $image->getClientOriginalName());
             PortfolioMedia::create([
                 'portfolio_id' => $portfolioId,
                 'type' => $type,
                 'file_path' => $path,
             ]);
         }
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

    public function nextStep()
    {
        $this->validateCurrentStep();
        $this->currentStep++;
        // Log ekleyerek kontrol edelim
        info('İleri adım tıklandı, currentStep: '.$this->currentStep);
    }

    // Geri adım
    public function previousStep()
    {
        $this->currentStep--;
    }

    // Geçerli adım doğrulaması
    protected function validateCurrentStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([

                'state_id' => 'required',
                'city_id' => 'required',
                'district_id' => 'required',
                'category_id' => 'required',
                'type_id' => 'required',
                'status' => 'required',
            ]);
        } elseif ($this->currentStep == 2) {
            if ($this->category_id == $this->landCategoryId) {
                $this->validate([

                    'similar' => 'nullable',
                    'height_limit' => 'nullable',
                    'zoning_status' => 'required|string',
                ]);
            } elseif ($this->category_id == $this->businessCategoryId) {
                $this->validate([

                    'zoning_status' => 'required',

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
        } elseif ($this->currentStep == 3) {
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
        } elseif ($this->currentStep == 4) {
            $this->validate([
                'owner_customer_id' => 'nullable',
                'has_partner' => 'nullable',
                'partner_customer_id' => 'nullable',

            ]);
        } elseif ($this->currentStep == 5) {
            $this->validate([


            ]);
        }
    }

    // Son adımda verileri kaydet
    public function save()
    {
        // 1. Adımda toplanan veriler
        $this->validate([
            'state_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'status' => 'required',
        ]);

        // 3. Adımda toplanan veriler
        $this->validate([
            'lot' => 'required|numeric',
            'parcel' => 'required|numeric',
            'portfolio_no' => 'required',
            'price' => 'required|string',
            'additional_fees' => 'nullable|string',
            'deed_type' => 'nullable|string',
            'property_no' => 'nullable|numeric',
            'deposit' => 'nullable|string',
            'isCredit' => 'nullable|string',
            'isSwap' => 'nullable|string',
        ]);

        // 4. Adımda toplanan veriler
        $this->validate([
            'owner_customer_id' => 'nullable',
            'has_partner' => 'nullable',
            'partner_customer_id' => 'nullable',
        ]);

        $portfolio = Portfolio::create([
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'district_id' => $this->district_id,
            'area_m2' => $this->area_m2,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'portfolio_no' => $this->portfolio_no,
            'price' => $this->price,
            'deposit' => $this->deposit,
            'lot' => $this->lot,
            'parcel' => $this->parcel,
            'property_no' => $this->property_no,
            'deed_type' => $this->deed_type,
            'isCredit' => $this->isCredit,
            'isSwap' => $this->isSwap,
            'advisor' => $this->advisor,
            'partner_customer_id' => $this->partner_customer_id ?: null,
            'owner_customer_id' => $this->owner_customer_id ?: null,
            'additional_fees' => $this->additional_fees,
            'advisor' => $this->advisor,
            'note' => $this->note,
            'description' => $this->description,
        ]);



        // Kategoriye göre ilgili modele kayıt yap
        if ($this->category_id == $this->landCategoryId) {
            $this->createLand($portfolio->id);
        } elseif ($this->category_id == $this->businessCategoryId) {
            $this->createBusiness($portfolio->id);
        } elseif ($this->category_id == $this->homeCategoryId) {
            $this->createHome($portfolio->id);
        }




        $this->dispatch('portfolio-created');
        $this->dispatch('notify', title: 'Başarılı!', text: 'Portföy başarıyla kaydedildi.', type: 'success');
        $this->reset('open');
    }

    // Arsa kaydetme
    protected function createLand($portfolioId)
    {
        Land::create([
            'portfolio_id' => $portfolioId,

            'zoning_status' => $this->zoning_status,
            'similar' => $this->similar,
            'height_limit' => $this->height_limit,
        ]);
    }

    // İşyeri kaydetme
    protected function createBusiness($portfolioId)
    {
       $data= Business::create([
            'portfolio_id' => $portfolioId,
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
        ]);


    }

    // Konut kaydetme
    protected function createHome($portfolioId)
    {
        Home::create([
            'portfolio_id' => $portfolioId,
            'room_count' => $this->room_count,
            'floor_level' => $this->floor_level,
            'total_floors' => $this->total_floors,
            'isFurnished' => $this->isFurnished,
            'isBalcon' => $this->isBalcon,
            'isElevator' => $this->isElevator,
        ]);
    }
    public function render()
    {
        return view('admin.portfolio.portfolio-wizard', [
            'states' => $this->states,
            'cities' => City::where('state_id', $this->state_id)->get(),
            'categories' => $this->categories,
            'advisorsList' => $this->advisorsList,
        ]);
    }
}
