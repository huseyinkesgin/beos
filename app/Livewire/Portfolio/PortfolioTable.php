<?php

namespace App\Livewire\Portfolio;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use App\Models\Category;
use App\Models\District;
use App\Models\Portfolio;
use App\Traits\HasSortable;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;
use App\Traits\PaginateReset;
use App\Exports\PortfoliosExport;
use App\Traits\ToggleActiveTrait;
use App\Traits\PortfolioFilterReset;
use App\Traits\PortfolioRestoreAndDeleteTrait;

class PortfolioTable extends Component
{
    use WithPagination;
    use HasSortable;
    use ToggleActiveTrait, PortfolioRestoreAndDeleteTrait;
    use PaginateReset, PortfolioFilterReset;

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
    public $adStatusFilter = 'all';

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
    public $totalKiralikArsa = 0;
    public $totalKiralikFabrika = 0;
    public $totalKiralikArsaDegeri = 0;
    public $totalKiralikFabrikaDegeri = 0;

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

    public function updated($propertyName)
    {
        if (in_array($propertyName, [
            'search',
            'activeFilter',
            'deletedFilter',
            'typeFilter',
            'categoryFilter',
            'statusFilter',
            'adStatusFilter',
            'stateFilter',
            'cityFilter',
            'districtFilter'
        ])) {
            $this->calculateWidgetTotals();
        }
    }

    /* ----------------------- WIDGET VERİLERİNİ HESAPLAMA ---------------------- */
    public function calculateWidgetTotals()
    {
        // Filtrelenmiş veriyi kullanarak satılık ve kiralık arsa ve fabrika bilgilerini getirin
        $filteredQuery = Portfolio::filter(
            $this->search,
            $this->activeFilter,
            $this->deletedFilter,
            $this->typeFilter,
            $this->categoryFilter,
            $this->statusFilter,
            $this->adStatusFilter,
            $this->stateFilter,
            $this->cityFilter,
            $this->districtFilter
        );
    
        // Satılık Arsa Sayısı ve Değeri
        $this->totalSatilikArsa = (clone $filteredQuery)
            ->where('category_id', $this->landCategoryId)
            ->where('status', 'Satılık')
            ->count();
    
        $this->totalSatilikArsaDegeri = (clone $filteredQuery)
            ->where('category_id', $this->landCategoryId)
            ->where('status', 'Satılık')
            ->sum('price');
    
        // Satılık Fabrika Sayısı ve Değeri
        $this->totalSatilikFabrika = (clone $filteredQuery)
            ->where('category_id', $this->businessCategoryId)
            ->where('status', 'Satılık')
            ->count();
    
        $this->totalSatilikFabrikaDegeri = (clone $filteredQuery)
            ->where('category_id', $this->businessCategoryId)
            ->where('status', 'Satılık')
            ->sum('price');
    
        // Kiralık Arsa Sayısı
        $this->totalKiralikArsa = (clone $filteredQuery)
            ->where('category_id', $this->landCategoryId)
            ->where('status', 'Kiralık')
            ->count();
    
        // Kiralık Fabrika Sayısı
        $this->totalKiralikFabrika = (clone $filteredQuery)
            ->where('category_id', $this->businessCategoryId)
            ->where('status', 'Kiralık')
            ->count();
    }
    
    


    public function resetComponent()
{
    // Tüm filtreler, sıralama ve sayfalama dahil olmak üzere bileşeni sıfırlayın
    $this->reset([
        'search', 'statusFilter', 'categoryFilter', 'stateFilter', 
        'cityFilter', 'districtFilter', 'typeFilter', 'activeFilter', 
        'deletedFilter', 'adStatusFilter', 'sortField', 'sortDirection', 
        'pagination'
    ]);

    // Varsayılan değerlerle widget verilerini güncelleyin
    $this->calculateWidgetTotals();

    // Bu bileşeni baştan yüklemek için `dispatch` ile yeniden yüklemeyi tetikleyin
    $this->dispatch('refreshTable');
}


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
            $this->statusFilter,
            $this->adStatusFilter,
            $this->stateFilter,   // İl filtresini ekleyin
            $this->cityFilter,    // İlçe filtresini ekleyin
            $this->districtFilter // Bölge filtresini ekleyin
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