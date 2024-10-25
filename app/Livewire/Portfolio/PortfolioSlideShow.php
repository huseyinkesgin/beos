<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;
use App\Models\PortfolioGallery;

class PortfolioSlideShow extends Component
{
    public $portfolioId;

    public $galleryImages = [];

    public $currentImageIndex = 0;

    public $showSlideshow = false;

    protected $listeners = ['openSlideShowModal' => 'openModal'];

    // Modalı açmak ve resim listesini yüklemek için işlev
    public function openModal($id)
    {
        $this->portfolioId = $id;

        // Portföy verilerini yükleyerek lot, parcel ve district_name değerlerini alıyoruz
        $portfolio = Portfolio::findOrFail($id);

        $this->loadGalleryImages();
        $this->showSlideshow = true; // Modalı aç
    }

    // Mevcut resimleri portföy ID'sine göre yükleme
    public function loadGalleryImages()
    {
        $this->galleryImages = PortfolioGallery::where('portfolio_id', $this->portfolioId)
            ->orderBy('order')
            ->get()
            ->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => asset('storage/'.$image->file_path),
                ];
            })
            ->toArray();
    }

    // Sonraki resme geçiş
    public function nextImage()
    {
        if ($this->currentImageIndex < count($this->galleryImages) - 1) {
            $this->currentImageIndex++;
        }
    }

    // Önceki resme geçiş
    public function previousImage()
    {
        if ($this->currentImageIndex > 0) {
            $this->currentImageIndex--;
        }
    }

    public function render()
    {
        return view('admin.portfolio.portfolio-slide-show');
    }
}
