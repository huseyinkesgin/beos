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

    public function closeModal()
{
    $this->open = false;
    $this->resetFields(); // Yeni bir reset metodu ile alanları sıfırlayacağız
}


    public function save()
    {
        $portfolio = $this->createPortfolio();
        $this->createLand($portfolio);

        $this->dispatch('refreshTable');
        $this->dispatch('closeModal');
        $this->dispatch('notify', title: 'Başarılı', text: 'Portföy başarıyla kayıt edildi!', type: 'success');
    }

    protected function createPortfolio()
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

    return Portfolio::create($validatedData);
}

protected function resetFields()
{
    $this->portfolio_no = null;
    $this->portfolio_id = null;
    $this->lot = null;
    $this->parcel = null;
    $this->price = null;
    $this->property_no = null;
    $this->area_m2 = null;
    $this->zoning_status = null;
    $this->similar = null;
    $this->height_limit = null;
    $this->isCredit = false;
    $this->deed_type = null;
    $this->isSwap = false;
    $this->description = null;
    $this->advisor = null;
    $this->partner_customer_id = null;
    $this->owner_customer_id = null;
    $this->note = null;
    $this->status = 'Satılık';
    $this->deposit = null;
    $this->additional_fees = null;
    $this->state_id = null;
    $this->city_id = null;
    $this->district_id = null;
    $this->category_id = null;
    $this->type_id = null;
    $this->form_path = null;
    $this->has_partner = false;
    $this->isActive = true;
}

protected function createLand($portfolio)
{
    if ($this->category_id == $this->landCategoryId) {
        $landData = $this->validate([
            'area_m2' => 'required|string',
            'zoning_status' => 'required|string',
            'similar' => 'nullable|string',
            'height_limit' => 'nullable|string',
        ]);

        $landData['portfolio_id'] = $portfolio->id;

        Land::create($landData);
    }
}

    public function render()
    {

        return view('admin.portfolio.portfolio-create', [
            //
        ]);
    }
}
