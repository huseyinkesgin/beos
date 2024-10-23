<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\District;
use App\Models\Portfolio;
use Livewire\WithFileUploads;
use App\Models\PortfolioMedia;
use Illuminate\Support\Facades\Storage;

class PortfolioMedias extends Component
{
    use WithFileUploads;


    public $portfolioId;
    public $districtName; // Bölge adı için yeni değişken
    public $district_id;
    public $lot; // Eksik tanımlanan özellik
    public $parcel;
    public $portfolio_id, $satellite_image, $feature_image, $e_imar_image, $city_image, $slope_image;
    public $existingSatelliteImage, $existingFeatureImage, $existingEImarImage, $existingCityImage, $existingSlopeImage;
    public $open = false;

    protected $listeners = ['openMediaModal' => 'openModal'];

    public function openModal($id)
    {
        $this->portfolioId = $id;

        // Portföy verilerini yükleyerek lot, parcel ve district_name değerlerini alıyoruz
        $portfolio = Portfolio::findOrFail($id);
        $this->lot = $portfolio->lot;
        $this->parcel = $portfolio->parcel;

        // District bilgisini portföyden ilişkiyle çekiyoruz
        if ($portfolio->district) {
            $this->districtName = $portfolio->district->name;
        } else {
            $this->districtName = 'Unknown'; // Eğer district bulunamazsa
        }

          // Mevcut resimleri yükleme
          $this->existingSatelliteImage = $this->getExistingMedia($portfolio->id, 'uydu');
          $this->existingFeatureImage = $this->getExistingMedia($portfolio->id, 'nitelik');
          $this->existingEImarImage = $this->getExistingMedia($portfolio->id, 'eimar');
          $this->existingCityImage = $this->getExistingMedia($portfolio->id, 'buyuksehir');
          $this->existingSlopeImage = $this->getExistingMedia($portfolio->id, 'eğim');

        $this->open = true;
    }

    public function save()
    {
        // Medya dosyalarını portföy numarasına göre kaydet
        $portfolio = Portfolio::findOrFail($this->portfolioId);

        $this->storeImage($portfolio->portfolio_no, $this->satellite_image, 'uydu');
        $this->storeImage($portfolio->portfolio_no, $this->feature_image, 'nitelik');
        $this->storeImage($portfolio->portfolio_no, $this->e_imar_image, 'eimar');
        $this->storeImage($portfolio->portfolio_no, $this->city_image, 'buyuksehir');
        $this->storeImage($portfolio->portfolio_no, $this->slope_image, 'eğim');

        $this->dispatch('media-uploaded');
        $this->dispatch('notify', title: 'Başarılı!', text: 'Medya başarıyla kaydedildi.', type: 'success');
        $this->reset();
    }

     // Veritabanında mevcut olan medyayı getirme
     private function getExistingMedia($portfolioId, $type)
     {
         $media = PortfolioMedia::where('portfolio_id', $portfolioId)->where('type', $type)->first();
         return $media ? Storage::url($media->file_path) : null;
     }

   // Resim kaydetme ve kontrol etme fonksiyonu
   private function storeImage($portfolioNo, $image, $type)
    {
        if ($image) {
            // Dosya adını districtName_lot_parcel_ şeklinde ayarlıyoruz
            $fileName = "{$this->districtName}_{$this->lot}_{$this->parcel}_{$image->getClientOriginalName()}";

            // Public diskine kaydet
            $path = $image->storeAs("portfolios/{$portfolioNo}", $fileName, 'public');

            // Veritabanında aynı türde bir resim var mı kontrol ediyoruz
            $existingMedia = PortfolioMedia::where('portfolio_id', $this->portfolioId)
                ->where('type', $type)
                ->first();

            if ($existingMedia) {
                // Eski dosya yolunu al ve sil
                Storage::disk('public')->delete($existingMedia->file_path);

                // Mevcut kaydı güncelle
                $existingMedia->update([
                    'file_path' => $path,
                ]);
            } else {
                // Yoksa yeni kayıt oluştur
                PortfolioMedia::create([
                    'portfolio_id' => $this->portfolioId,
                    'type' => $type,
                    'file_path' => $path,
                ]);
            }
        }
    }

    public function render()
    {
        return view('admin.portfolio.portfolio-medias', [
            'existingSatelliteImage' => $this->existingSatelliteImage,
            'existingFeatureImage' => $this->existingFeatureImage,
            'existingEImarImage' => $this->existingEImarImage,
            'existingCityImage' => $this->existingCityImage,
            'existingSlopeImage' => $this->existingSlopeImage,
        ]);
    }
}

