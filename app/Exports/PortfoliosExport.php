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
    private $categoryId;
    private $businessCategoryId;
    private $landCategoryId;

    // Kategori ID'lerini geçiyoruz
    public function __construct($categoryId = null, $businessCategoryId = null, $landCategoryId = null)
    {
        $this->categoryId = $categoryId;
        $this->businessCategoryId = $businessCategoryId;
        $this->landCategoryId = $landCategoryId;
    }

    public function collection()
    {
        return Portfolio::with(['category', 'type', 'state', 'city', 'district', 'owner', 'partner'])
            ->when($this->categoryId, fn($query) => $query->where('category_id', $this->categoryId))
            ->get();
    }

    public function headings(): array
    {
        $headings = [
            'Portföy No', 'İl', 'İlçe', 'Bölge',  'Ada/Parsel','Tip', 'Durum','Arsa (m²)', 'Fiyat (₺)',
        ];

        if ($this->categoryId == $this->landCategoryId) {
            // Arsa kategorisi başlıkları

            $headings[] = 'm² Fiyatı (₺)';
            $headings[] = 'İmar Durumu';
            $headings[] = 'Tapu';
            $headings[] = 'Mal Sahibi';
            $headings[] = 'Partner';
        } elseif ($this->categoryId == $this->businessCategoryId) {
            // İş yeri kategorisi başlıkları
            $headings[] = 'Ek Ücret';
            $headings[] = 'Kapalı Alan';
            $headings[] = 'İşletme Alan';
            $headings[] = 'Ofis Alanı';
            $headings[] = 'Mal Sahibi';
            $headings[] = 'Partner';
        } else {
            // Tüm kategoriler veya diğer durumlar için ortak başlıklar
            $headings[] = 'İmar Durumu';
            $headings[] = 'Kapalı Alan';
            $headings[] = 'İşletme Alan';
        }

        return $headings;
    }


    public function map($portfolio): array
    {
        $pricePerSquareMeter = $portfolio->area_m2 > 0 ? round($portfolio->price / $portfolio->area_m2) : 0;

        $row = [
            $portfolio->portfolio_no,
            optional($portfolio->state)->name,
            optional($portfolio->city)->name,
            optional($portfolio->district)->name,
            $portfolio->lot . '/' . $portfolio->parcel,
            optional($portfolio->type)->name,
            $portfolio->status,
            number_format($portfolio->area_m2, 0) . ' m²',
            number_format($portfolio->price, 0) . ' ₺',





        ];

        // Arsa kategorisi için İmar Durumu ekle
        if ($this->categoryId == $this->landCategoryId || is_null($this->categoryId)) {
            $row[] =  number_format($pricePerSquareMeter, 0) . ' ₺';
            $row[] = optional($portfolio->land)->zoning_status;
            $row[] = $portfolio->deed_type;
            $row[] = optional($portfolio->owner)->name;
            $row[] = optional($portfolio->partner)->name;
        }

        // İş yeri kategorisi için Kapalı Alan ve İşletme Alan ekle
        if ($this->categoryId == $this->businessCategoryId || is_null($this->categoryId)) {
            $row[] = $portfolio->additional_fees;
            $row[] = isset($portfolio->business->closed_area) ? number_format($portfolio->business->closed_area, 0) . ' m²' : 'N/A';
            $row[] = isset($portfolio->business->business_area) ? number_format($portfolio->business->business_area, 0) . ' m²' : 'N/A';
            $row[] = isset($portfolio->business->office_area) ? number_format($portfolio->business->office_area, 0) . ' m²' : 'N/A';
            $row[] = optional($portfolio->owner)->name;
            $row[] = optional($portfolio->partner)->name;
        }

        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }

    public function properties(): array
    {
        return [
            'creator' => 'Nedim Akbacak',
            'lastModifiedBy' => 'Nedim Akbacak',
            'title' => 'Portföy Listesi',
            'description' => 'Portföy verilerinin Excel formatında dökümü',
            'subject' => 'Portföyler',
            'keywords' => 'portföy, export, excel',
            'category' => 'Export',
            'manager' => 'Nedim Akbacak',
            'company' => 'Burada Yapı Gayrimenkul A.Ş.',
        ];
    }
}
