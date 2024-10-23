<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;
use Livewire\WithFileUploads;
use App\Models\PortfolioGallery;
use Illuminate\Support\Facades\Storage;

class PortfolioGalleries extends Component
{
    use WithFileUploads;

    public $portfolioId;
    public $districtName;
    public $district_id;
    public $lot;
    public $parcel;
    public $galleryImages = [];
    public $newImages = [];
    public $open = false;

    protected $listeners = ['openGalleryModal' => 'openModal', 'updateImageOrder'];

    public function openModal($id)
    {
        $this->portfolioId = $id;
        $this->loadExistingImages();

        $portfolio = Portfolio::findOrFail($id);
        $this->lot = $portfolio->lot;
        $this->parcel = $portfolio->parcel;
        $this->open = true;
    }

    // Mevcut resimleri yükle
    public function loadExistingImages()
    {
        $this->galleryImages = PortfolioGallery::where('portfolio_id', $this->portfolioId)
            ->orderBy('order')  // Sıralama
            ->get()
            ->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => asset('storage/' . $image->file_path),
                    'order' => $image->order,
                ];
            })
            ->toArray();
    }

    // Yeni resim ekleme
    public function save()
    {
        foreach ($this->newImages as $image) {
            $filePath = $image->store('portfolio_gallery', 'public');

            PortfolioGallery::create([
                'portfolio_id' => $this->portfolioId,
                'file_path' => $filePath,
                'order' => PortfolioGallery::where('portfolio_id', $this->portfolioId)->max('order') + 1,
            ]);
        }

        $this->reset('newImages');
        $this->loadExistingImages();
        $this->dispatch('notify', title: 'Başarılı!', text: 'Resimler başarıyla yüklendi.', type: 'success');
        $this->reset('open');
    }

    // Sürükle-bırak sıralamayı güncelleme
    public function updateImageOrder($orderedIds)
    {
        foreach ($orderedIds as $index => $id) {
            PortfolioGallery::where('id', $id)->update(['order' => $index + 1]);
        }

        $this->loadExistingImages();
    }

    // Resmi kaldırma
    public function removeImage($imageId)
    {
        $image = PortfolioGallery::findOrFail($imageId);

        // Fiziksel dosyayı sil
        if (Storage::disk('public')->exists($image->file_path)) {
            Storage::disk('public')->delete($image->file_path);
        }

        // Veritabanından sil
        $image->delete();

        // Mevcut resimleri tekrar yükle
        $this->loadExistingImages();

        // Başarı bildirimi
        $this->dispatch('notify', title: 'Başarılı!', text: 'Resim başarıyla silindi.', type: 'success');
    }

    // PortfolioGallery resimlerini kaydetme fonksiyonu
    private function storeGalleryImage($portfolioId, $image)
    {
        if ($image) {
            // Dosya adını oluşturuyoruz
            $fileName = "{$this->lot}_{$this->parcel}_{$image->getClientOriginalName()}";

            // Resmi 'portfolios/portfolio_no/gallery' klasörüne kaydediyoruz
            $portfolioNo = Portfolio::find($portfolioId)->portfolio_no;
            $path = $image->storeAs("portfolios/{$portfolioNo}/gallery", $fileName, 'public');

            // Veritabanına kaydetme işlemi
            PortfolioGallery::create([
                'portfolio_id' => $portfolioId,
                'file_path' => $path,
                'order' => PortfolioGallery::where('portfolio_id', $portfolioId)->max('order') + 1, // Sıralama
            ]);
        }
    }

    public function render()
    {
        return view('admin.portfolio.portfolio-galleries');
    }
}
