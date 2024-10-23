<?php

namespace App\Exports;

use App\Models\Portfolio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithProperties;

class PortfoliosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithProperties
{
    // Verileri toplama
    public function collection()
    {
        // İlişkili modelleri yükleyerek alıyoruz
        return Portfolio::with(['category', 'type', 'state', 'city', 'district','owner','partner'])->get();
    }

    // Başlıkları tanımlama
    public function headings(): array
    {
        return [
            'Portföy No',
            'İl',
            'İlçe',
            'Bölge',
            'Tip',
            'Durum',
            'Fiyat (₺)',
            'Arsa (m²)',
            'm² Fiyatı (₺)',  // Yeni sütun: m² başına fiyat
            'İmar Durumu',
            'Tapu',
            'Ada/Parsel',
            'Mal Sahibi',
            'Partner'
        ];
    }

    // Verileri Excel için düzenleyip ilişkili isimleri ekliyoruz
    public function map($portfolio): array
    {
        $pricePerSquareMeter = $portfolio->area_m2 > 0 ? round($portfolio->price / $portfolio->area_m2) : 0;

        return [
            $portfolio->portfolio_no,
            optional($portfolio->state)->name,      // İl ismi
            optional($portfolio->city)->name,       // İlçe ismi
            optional($portfolio->district)->name,   // Bölge ismi
            optional($portfolio->type)->name,       // Tip ismi
            $portfolio->status,                     // Durum
            number_format($portfolio->price, 0) . ' ₺',    // Fiyat
            number_format($portfolio->area_m2, 2) . ' m²',    // Arsa m²
            number_format($pricePerSquareMeter, 0) . ' ₺',   // m² başına fiyat
            optional($portfolio->land)->zoning_status, // İmar durumu
            $portfolio->deed_type, // Tapu
            $portfolio->lot . '/' . $portfolio->parcel,  // Ada/Parsel
            optional($portfolio->owner)->name, // Mal Sahibi
            optional($portfolio->partner)->name, // Partner ismi
        ];
    }

    // Stil ayarlamaları
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }

    // Dosya özellikleri (güvensiz uyarısını çözmek için)
    public function properties(): array
    {
        return [
            'creator'        => 'Nedim Akbacak',
            'lastModifiedBy' => 'Nedim Akbacak',
            'title'          => 'Portföy Listesi',
            'description'    => 'Portföy verilerinin Excel formatında dökümü',
            'subject'        => 'Portföyler',
            'keywords'       => 'portföy, export, excel',
            'category'       => 'Export',
            'manager'        => 'Nedim Akbacak',
            'company'        => 'Burada Yapı Gayrimenkul A.Ş.',
        ];
    }
}
