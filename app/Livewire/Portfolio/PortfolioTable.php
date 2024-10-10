<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;
use Livewire\WithPagination;

class PortfolioTable extends Component
{
    use WithPagination;

    public $search = '';
    public $typeFilter = '';
    public $categoryFilter = '';

    protected $listeners = ['refreshTable' => '$refresh'];

    public function render()
    {
        $portfolios = Portfolio::query()
            ->when($this->search, fn($query) => $query->where('portfolio_no', 'like', "%{$this->search}%"))
            ->when($this->typeFilter, fn($query) => $query->where('type', $this->typeFilter))
            ->when($this->categoryFilter, fn($query) => $query->where('category', $this->categoryFilter))
            ->paginate(10);

        return view('admin.portfolio.portfolio-table', [
            'portfolios' => $portfolios,
        ]);
    }
}
