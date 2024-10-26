<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;

class PortfolioShow extends Component
{
    public $portfolio;
    public $portfolioId;

    public function mount($portfolioId)
    {
        $this->portfolioId = $portfolioId;
        $this->loadPortfolio();
    }

    public function loadPortfolio()
    {
        $this->portfolio = Portfolio::with(['category', 'state', 'city', 'district', 'owner', 'partner', 'media','gallery'])
            ->findOrFail($this->portfolioId);
    }

    public function render()
    {
        return view('admin.portfolio.portfolio-show');
    }
}
