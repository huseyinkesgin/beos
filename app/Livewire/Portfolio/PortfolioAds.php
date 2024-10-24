<?php 

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;
use App\Models\PortfolioAd;

class PortfolioAds extends Component
{
    public $portfolioId;
    public $site_name, $ads_id, $ads_link, $status;
    public $open = false;
    public $existingAds = []; // Default olarak boş bir array

    protected $listeners = ['openAdsModal' => 'openModal'];

    public function openModal($id)
    {
        $this->portfolioId = $id;

        // Portföyün mevcut ilanlarını çekiyoruz
        $this->existingAds = PortfolioAd::where('portfolio_id', $id)->get();

        $this->open = true;
    }

    public function save()
    {
        // Aynı siteye ait ilanı daha önce eklemiş mi kontrol et
        $existingAd = PortfolioAd::where('portfolio_id', $this->portfolioId)
                                  ->where('site_name', $this->site_name)
                                  ->first();

        if ($existingAd) {
            // Eğer aynı siteye ait ilan varsa kaydı engelle
            session()->flash('error', 'Bu siteye ait ilan zaten mevcut!');
            return;
        }

        $this->validate([
            'site_name' => 'required',
            'ads_id' => 'required|numeric',
            'ads_link' => 'required',
            'status' => 'required',
        ]);

        PortfolioAd::create([
            'portfolio_id' => $this->portfolioId,
            'site_name' => $this->site_name,
            'ads_id' => $this->ads_id,
            'ads_link' => $this->ads_link,
            'status' => $this->status,
        ]);

        // İlanlar güncellendikten sonra ilan listesini tekrar alıyoruz
        $this->existingAds = PortfolioAd::where('portfolio_id', $this->portfolioId)->get();
        $this->reset(['site_name', 'ads_id', 'ads_link', 'status']); // Formu temizle
    }

    public function render()
    {
        return view('admin.portfolio.portfolio-ads', [
            'existingAds' => $this->existingAds, // Mevcut ilanları view'e gönderiyoruz
        ]);
    }
}
