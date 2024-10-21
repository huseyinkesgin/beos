<?php

namespace App\Models;

use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'license_plate',
        'brand',
        'model',
        'year',
        'purchase_date',
        'sell_date',
        'chassis_number',
        'registration_number',
        'isActive',
        'registration_image_path',
        'insurance_policy_image_path',
        'insurance_policy_expiry',
        'casco_policy_image_path',
        'casco_policy_expiry',
        'additional_documents',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'purchase_date' => 'date',
            'sell_date' => 'date',
            'insurance_policy_expiry' => 'date',
            'casco_policy_expiry' => 'date',
            'is_active' => 'boolean',
            'additional_documents' => 'array', // Ek belgeleri JSON olarak saklamak
        ];
    }

    /**
     * Ruhsat resminin tam yolunu döndürmek için bir accessor.
     */
    public function getRegistrationImageUrlAttribute()
    {
        return $this->registration_image_path
            ? asset('storage/' . $this->registration_image_path)
            : null;
    }

    /**
     * Sigorta poliçesi resminin tam yolunu döndürmek için bir accessor.
     */
    public function getInsurancePolicyImageUrlAttribute()
    {
        return $this->insurance_policy_image_path
            ? asset('storage/' . $this->insurance_policy_image_path)
            : null;
    }

    /**
     * Kasko poliçesi resminin tam yolunu döndürmek için bir accessor.
     */
    public function getCascoPolicyImageUrlAttribute()
    {
        return $this->casco_policy_image_path
            ? asset('storage/' . $this->casco_policy_image_path)
            : null;
    }
}
}
