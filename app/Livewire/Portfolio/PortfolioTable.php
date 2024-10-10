<?php

namespace App\Livewire\Portfolio;

use App\Models\Home;
use App\Models\Land;
use Livewire\Component;
use App\Models\Business;
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
        $lands = Land::query()
            ->when($this->search, fn($query) => $query->where('portfolio_no', 'like', "%{$this->search}%"))
            ->get();

        $homes = Home::query()
            ->when($this->search, fn($query) => $query->where('portfolio_no', 'like', "%{$this->search}%"))
            ->get();

        $businesses = Business::query()
            ->when($this->search, fn($query) => $query->where('portfolio_no', 'like', "%{$this->search}%"))
            ->get();

        $portfolios = $lands->merge($homes)->merge($businesses)->paginate(10);

        return view('admin.portfolio.portfolio-table', [
            'portfolios' => $portfolios,
        ]);
}}
