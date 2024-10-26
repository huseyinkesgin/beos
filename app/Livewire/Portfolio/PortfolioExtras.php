<?php

namespace App\Livewire\Portfolio;

use Livewire\Component;
use App\Models\Portfolio;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Models\PortfolioExtra;
use Illuminate\Support\Facades\Storage;

class PortfolioExtras extends Component
{
    use WithFileUploads;

    public $portfolioId;
    public $file;
    public $file_name;

    // Portfolio bilgileri
    public $lot;
    public $parcel;

    public $existingExtras = [];
    public $open = false;

    #[On('openExtraModal')]
    public function openModal($id)
    {
        $this->reset(); // Tüm form alanlarını sıfırla
        $this->portfolioId = $id;
        $this->loadExistingExtras();

        // Portfolio bilgilerini çekiyoruz
        $portfolio = Portfolio::findOrFail($id);
        $this->lot = $portfolio->lot;
        $this->parcel = $portfolio->parcel;

        $this->open = true;
    }

    public function loadExistingExtras()
    {
        $this->existingExtras = PortfolioExtra::where('portfolio_id', $this->portfolioId)->get();
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,dwg,png,jpg,jpeg|max:10240',
            'file_name' => 'required|string',
        ]);

        $portfolio = Portfolio::findOrFail($this->portfolioId);
        $portfolioNo = $portfolio->portfolio_no;

        // Dosyayı kaydediyoruz
        $filePath = $this->file->storeAs("portfolios/{$portfolioNo}/extras", $this->file->getClientOriginalName(), 'public');

        PortfolioExtra::create([
            'portfolio_id' => $this->portfolioId,
            'file_name' => $this->file_name,
            'file_path' => $filePath,
            'file_type' => $this->file->getClientOriginalExtension(),
        ]);

        $this->loadExistingExtras();
        $this->reset('file', 'file_name');
    }

    public function deleteFile($extraId)
    {
        $extra = PortfolioExtra::findOrFail($extraId);

        // Dosya var ise fiziksel olarak sil
        if (Storage::exists($extra->file_path)) {
            Storage::delete($extra->file_path);
        }

        // Veritabanından kaydı sil
        $extra->delete();

        // Güncel listeyi yükleyin
        $this->loadExistingExtras();
    }

    public function render()
    {
        return view('admin.portfolio.portfolio-extras', [
            'existingExtras' => $this->existingExtras,
        ]);
    }
}
