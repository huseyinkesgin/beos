<?php

namespace App\Livewire\Portfolio;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use App\Models\Category;
use App\Models\District;
use App\Models\Portfolio;
use App\Traits\HasSortable;
use App\Traits\SearchReset;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;
use App\Traits\PaginateReset;
use App\Exports\PortfoliosExport;
use App\Traits\ActiveFilterReset;
use App\Traits\DeleteFilterReset;
use App\Traits\ToggleActiveTrait;
use App\Traits\PortfolioRestoreAndDeleteTrait;

class PortfolioTable extends Component
{
    use WithPagination;
    use HasSortable;
    use ToggleActiveTrait,PortfolioRestoreAndDeleteTrait;
    use SearchReset, DeleteFilterReset, ActiveFilterReset, PaginateReset;

    /* -------------------------------- FİLTRELER ------------------------------- */
    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $stateFilter = '';
    public $cityFilter = '';
    public $districtFilter = '';
    public $typeFilter = '';
    public $activeFilter = 'all';
    public $deletedFilter = 'without';

    /* ----------------------------- TABLO DETAYLARI ---------------------------- */
    public $sortField = 'created_at';
    public $sortDirection = 'asc';
    public $pagination = 10;
    public $modelClass = Portfolio::class;

    /* --------------------------- İL-İLÇE-BÖLGE İÇİN --------------------------- */
    public $cities = [];
    public $districts = [];

    /* ------------------- TABLODA KATEGORİ ÇEŞİDİ YAPMAK İÇİN ------------------ */
    public $businessCategoryId;
    public $landCategoryId;

    /* ----------------------------- WİDGET VERİLERİ ---------------------------- */
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

    public $priceEditing = null; // Düzenlenen portföyün ID’sini saklayacak
public $newPrice = null;
    /* -------------------------- EXPORT VE IMPORT İÇİN ------------------------- */
    protected $excel;



    protected $listeners = ['refreshTable' => '$refresh'];

    public function __construct()
    {
        $this->excel = app(Excel::class);  // Bağımlılığı burada kullanıyoruz
    }

    public function export()
    {
        return $this->excel->download(
            new PortfoliosExport($this->categoryFilter, $this->businessCategoryId, $this->landCategoryId),
            'portfolios.xlsx'
        );
    }

    public function editPrice($portfolioId, $currentPrice)
    {
        $this->priceEditing = $portfolioId;
        $this->newPrice = $currentPrice;
    }

// Yeni fiyatı kaydetme
// Yeni fiyatı kaydetme
public function savePrice($portfolioId)
{
    // `newPrice` alanının boş veya negatif olup olmadığını kontrol et
    if (is_null($this->newPrice) || $this->newPrice < 0) {
        // Eğer `newPrice` geçerli değilse düzenleme modundan çık
        $this->priceEditing = null;
        $this->newPrice = null;
        return;
    }

    $portfolio = Portfolio::find($portfolioId);
    if ($portfolio) {
        $portfolio->price = $this->newPrice;
        $portfolio->save();
    }

    // Düzenleme modundan çık
    $this->priceEditing = null;
    $this->newPrice = null;

    // Widget verilerini güncelle
    $this->calculateWidgetTotals();
}

    public function mount()
    {
        $this->businessCategoryId = Category::where('name', 'İşyeri')->first()->id ?? null;
        $this->landCategoryId = Category::where('name', 'Arsa')->first()->id ?? null;
        $this->cities = City::all();
        $this->districts = District::all();

        $this->calculateWidgetTotals();
    }

    /* ------------------------- İL-İLÇE- BÖLGE DİNAMİK ------------------------- */
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



    /* ----------------------- WIDGET VERİLERİNİ HESAPLAMA ---------------------- */
    public function calculateWidgetTotals()
    {
        $this->totalSatilikArsa = Portfolio::filter(null, null, null, 'Arsa', null, 'Satılık')->count();
        $this->totalSatilikFabrika = Portfolio::filter(null, null, null, 'Fabrika', null, 'Satılık')->count();
        $this->totalSatilik = Portfolio::where('status', 'Satılık')->count();
        $this->totalKiralik = Portfolio::where('status', 'Kiralık')->count();
        $this->totalAktif = Portfolio::where('isActive', true)->count();
        $this->totalPasif = Portfolio::where('isActive', false)->count();
        $this->totalSatilikArsaDegeri = Portfolio::filter(null, null, null, 'Arsa', null, 'Satılık')->sum('price');
        $this->totalSatilikFabrikaDegeri = Portfolio::filter(null, null, null, 'Fabrika', null, 'Satılık')->sum('price');
        $this->totalSatilikDepoDegeri = Portfolio::filter(null, null, null, 'Depo', null, 'Satılık')->sum('price');
        $this->totalKiraDegeri = Portfolio::where('status', 'Kiralık')->sum('price');
    }

    // public function restore($id)
    // {
    //     $this->restorePortfolio($id);  // Trait'teki restore metodunu kullanıyoruz
    // }

    // public function forceDelete($id)
    // {
    //     $this->forceDeletePortfolio($id);  // Trait'teki forceDelete metodunu kullanıyoruz
    // }

    #[On('portfolio-created')]
    #[On('portfolio-edited')]
    #[On('portfolio-trashed')]
    #[On('portfolio-deleted')]
    #[On('portfolio-restored')]
    public function render()
    {
        $portfolios = Portfolio::filter(
            $this->search,
            $this->activeFilter,
            $this->deletedFilter,
            $this->typeFilter,
            $this->categoryFilter,
            $this->statusFilter
        )
            ->sortable($this->sortField, $this->sortDirection)
            ->paginate($this->pagination);

        return view('admin.portfolio.portfolio-table', [
            'portfolios' => $portfolios,
            'categories' => Category::active()->get(),
            'states' => State::all(),
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