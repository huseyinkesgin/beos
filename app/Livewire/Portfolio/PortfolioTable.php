<?php

namespace App\Livewire\Portfolio;

use App\Models\City;
use App\Models\Home;
use App\Models\Land;
use App\Models\State;
use Livewire\Component;
use App\Models\Business;
use App\Models\Category;
use App\Models\District;
use App\Models\Portfolio;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PortfolioTable extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $stateFilter = '';
    public $cityFilter = '';
    public $districtFilter = '';
    public $isActiveFilter = '';
    public $pagination = 10;

    public $cities = [];
    public $districts = [];
    public $businessCategoryId;

     // Widget verileri
     public $totalSatilik = 0;
     public $totalKiralik = 0;
     public $totalAktif = 0;
     public $totalPasif = 0;
     public $totalSatilikArsaDegeri = 0;
     public $totalKiraDegeri = 0;


     public $totalSatilikArsa = 0;
     public $totalSatilikFabrika = 0;
     public $totalSatilikFabrikaDegeri = 0;
    public $totalSatilikDepoDegeri = 0;


    protected $listeners = ['refreshTable' => '$refresh'];


    public function mount()
    {
        $this->businessCategoryId = Category::where('name', 'İşyeri')->first()->id ?? null;
        $this->cities = City::all(); // Başlangıçta boş bırakılabilir, il seçimine göre dinamik
        $this->districts = District::all(); // Başlangıçta boş bırakılabilir, ilçe seçimine göre dinamik

        $this->calculateWidgetTotals();
    }

    public function updatedStateFilter($stateId)
    {
        $this->cities = City::where('state_id', $stateId)->get();
        $this->cityFilter = '';
        $this->districtFilter = '';
        $this->districts = collect();
    }

    public function updatedCityFilter($cityId)
    {
        $this->districts = District::where('city_id', $cityId)->get();
        $this->districtFilter = '';
    }

    public function toggleActive($portfolioId)
    {
        $portfolio = Portfolio::find($portfolioId);
        if ($portfolio) {
            $portfolio->isActive = ! $portfolio->isActive;
            $portfolio->save();
            $this->dispatch('notify', title: 'Başarılı', text: 'Portföy durumu başarlı bir şekilde güncellendi!', type: 'success');
        }
    }

     // Widget verilerini hesapla
     public function calculateWidgetTotals()
     {
        $this->totalSatilikArsa = Portfolio::ofStatus('Satılık')->ofType('Arsa')->count();
        $this->totalSatilikFabrika = Portfolio::ofStatus('Satılık')->ofType('Fabrika')->count();

         $this->totalSatilik = Portfolio::where('status', 'Satılık')->count();
         $this->totalKiralik = Portfolio::where('status', 'Kiralık')->count();
         $this->totalAktif = Portfolio::where('isActive', true)->count();
         $this->totalPasif = Portfolio::where('isActive', false)->count();
         $this->totalSatilikArsaDegeri = Portfolio::ofStatus('Satılık')->ofType('Arsa')->sum('price');
         $this->totalSatilikFabrikaDegeri = Portfolio::ofStatus('Satılık')->ofType('Fabrika')->sum('price');
         $this->totalSatilikDepoDegeri = Portfolio::ofStatus('Satılık')->ofType('Depo')->sum('price');
         $this->totalKiraDegeri = Portfolio::where('status', 'Kiralık')->sum('price');
     }

     public function render()
     {
         $portfolios = Portfolio::query()
             ->when($this->search, fn($query) => $query->where('portfolio_no', 'like', "%{$this->search}%"))
             ->when($this->categoryFilter, fn($query) => $query->where('category_id', $this->categoryFilter))
             ->when($this->stateFilter, fn($query) => $query->where('state_id', $this->stateFilter))
             ->when($this->cityFilter, fn($query) => $query->where('city_id', $this->cityFilter))
             ->when($this->districtFilter, fn($query) => $query->where('district_id', $this->districtFilter))
             ->when($this->statusFilter, fn($query) => $query->where('status', $this->statusFilter))
             ->when($this->isActiveFilter !== '', fn($query) => $query->where('isActive', $this->isActiveFilter))
             ->paginate($this->pagination);

         $categories = Category::active()->get();
         $states = State::all();

         return view('admin.portfolio.portfolio-table', [
             'portfolios' => $portfolios,
             'categories' => $categories,
             'states' => $states,
             'cities' => $this->cities,
             'districts' => $this->districts,
             'totalSatilik' => $this->totalSatilik,
             'totalKiralik' => $this->totalKiralik,
             'totalAktif' => $this->totalAktif,
             'totalPasif' => $this->totalPasif,
             'totalSatilikArsaDegeri' => $this->totalSatilikArsaDegeri,
             'totalKiraDegeri' => $this->totalKiraDegeri,
             'totalSatilikArsa' => $this->totalSatilikArsa,
             'totalSatilikFabrikaDegeri' => $this->totalSatilikFabrikaDegeri,
             'totalSatilikDepoDegeri' => $this->totalSatilikDepoDegeri,
             'totalSatilikFabrika' => $this->totalSatilikFabrika,
         ]);
     }
}
