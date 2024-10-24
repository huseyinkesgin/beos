<?php


namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\PortfolioGallery;

class PortfolioSlideShow extends Component
{
    public $portfolioId;
    public $galleryImages = [];
    public $currentImageIndex = 0;
    public $showSlideshow = false;




    protected $listeners = ['openSlideShowModal' => 'openModal'];

    public function mount($portfolioId = null)
    {
        if ($portfolioId) {
            $this->portfolioId = $portfolioId;
            $this->loadGalleryImages();
        }
    }

    // Modalı açmak ve resim listesini yüklemek için işlev
    public function openModal($portfolioId)
{
    $this->portfolioId = $portfolioId;
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
                    'url' => asset('storage/' . $image->file_path),
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
