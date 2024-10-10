<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    protected $fillable = [
        'uuid',              // Benzersiz kimlik
        'price',             // Ücret
        'zoning_status',     // İmar Durumu
        'area_m2',           // m²
        'lot',               // Ada
        'parcel',            // Parsel
        'similar',           // Emsal
        'height_limit',      // Gabari
        'isCredit',          // Krediye Uygunluk
        'deed_type',         // Tapu Çeşidi
        'property_no',       // Taşınmaz No
        'isSwap',            // Takas Durumu
        'state_id',          // İl
        'city_id',           // İlçe
        'district_id',       // Bölge
        'description',       // Açıklama
        'portfolio_no',      // Portföy No
        'advisor',           // Danışman
        'has_partner',       // Partner Var Mı
        'partner_customer_id', // Partner Listesi
        'owner_customer_id',   // Mal Sahibi
        'isActive',           // Aktif Durum
        'note',               // Not
    ];
}
