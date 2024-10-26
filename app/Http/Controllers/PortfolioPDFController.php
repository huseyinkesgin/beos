<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioPDFController extends Controller
{
    public function generate($id)
    {
        // Portföyü gerekli ilişkilerle yükleyelim
        $portfolio = Portfolio::with(['category', 'state', 'city', 'district', 'extras', 'gallery','land','business'])->findOrFail($id);

        // PDF dosyasını oluşturuyoruz
        $pdf = Pdf::loadView('pdf.portfolio', compact('portfolio'));

        // PDF çıktısı indirme olarak sunulacak
        return $pdf->download("Portfolio_{$portfolio->portfolio_no}.pdf");
    }
}
