<?php

namespace App\Livewire\Portfolio;

use App\Models\Home;
use App\Models\Land;
use Livewire\Component;
use App\Models\Business;
use App\Models\Category;
use App\Models\Portfolio;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PortfolioTable extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $pagination = 10;

    protected $listeners = ['refreshTable' => '$refresh'];

    public function render()
    {
        $portfolios = Portfolio::query()
            ->when($this->search, fn($query) => $query->where('portfolio_no', 'like', "%{$this->search}%"))
            ->when($this->categoryFilter, fn($query) => $query->where('category_id', $this->categoryFilter))
            ->paginate($this->pagination);

        $categories = Category::active()->get(); // Kategorileri al ve view'a gönder

        return view('admin.portfolio.portfolio-table', [
            'portfolios' => $portfolios,
            'categories' => $categories,
        ]);
    }
}
