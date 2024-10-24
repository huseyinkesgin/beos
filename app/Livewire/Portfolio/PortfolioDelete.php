<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;
use Livewire\Attributes\On;

class PortfolioDelete extends Component
{

    public $portfolioId;
    public $open = false;

    #[On('openDeleteModal')]
    public function confirmDelete($id)
    {
        $this->portfolioId = $id;
        $this->open = true;
    }

    public function delete()
    {
        $portfolio = Portfolio::findOrFail($this->portfolioId);
        $portfolio->delete();

        $this->dispatch('portfolio-trashed');
        $this->dispatch('notify', title: 'Başarılı', text: 'İl başarılı bir şekilde çöp kutusuna gönderidi!', type: 'success');
        $this->reset(['portfolioId', 'open']);
    }

    public function render()
    {
        return view('admin.portfolio.portfolio-delete');
    }
}
