<?php

namespace App\Models;

use App\Traits\ScopesTrait;
use App\Models\PortfolioExtra;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use ScopesTrait, SoftDeletes;

    protected $fillable = [
        'state_id', 'city_id', 'district_id', 'area_m2', 'status', 'category_id', 'type_id',
        'portfolio_no', 'price', 'deposit', 'lot', 'parcel', 'property_no', 'deed_type',
        'isCredit', 'isSwap', 'advisor', 'partner_customer_id', 'owner_customer_id',
        'additional_fees', 'isActive', 'description', 'note',
    ];

    // İlişkiler
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function owner()
    {
        return $this->belongsTo(Customer::class, 'owner_customer_id');
    }

    public function partner()
    {
        return $this->belongsTo(Customer::class, 'partner_customer_id');
    }

    public function business()
    {
        return $this->hasOne(Business::class, 'portfolio_id');
    }

    public function land()
    {
        return $this->hasOne(Land::class, 'portfolio_id');
    }

    public function media()
    {
        return $this->hasMany(PortfolioMedia::class);
    }

    public function ads()
    {
        return $this->hasMany(PortfolioAd::class);
    }

    public function gallery()
    {
        return $this->hasMany(PortfolioGallery::class);
    }

    public function home()
    {
        return $this->hasOne(Home::class);
    }

    public function extras()
    {
        return $this->hasMany(PortfolioExtra::class);
    }

    public function advisorPersonnel()
    {
        return $this->belongsTo(Personnel::class, 'advisor');
    }

    // Soft delete işleminde ilişkileri de silme
    protected static function booted()
    {
        static::deleting(function ($portfolio) {
            $portfolio->ads()->delete();
            $portfolio->galleries()->delete();
            $portfolio->media()->delete();
            $portfolio->business()->delete();
            $portfolio->land()->delete();
            $portfolio->home()->delete();
        });
    }

    // Filtreleme işlemlerini tek bir metod altında toplama
    public function scopeFilter($query, $search, $activeFilter, $deletedFilter, $typeFilter, $categoryFilter, $statusFilter, $adStatusFilter = 'all', $stateFilter = null, $cityFilter = null, $districtFilter = null)
    {
        return $query
            ->when($search, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('portfolio_no', 'like', "%{$search}%")
                      ->orWhere('lot', 'like', "%{$search}%")
                      ->orWhere('parcel', 'like', "%{$search}%")
                      ->orWhere('price', 'like', "%{$search}%")
                      ->orWhere('area_m2', 'like', "%{$search}%")
                      ->orWhereHas('state', fn($q) => $q->where('name', 'like', "%{$search}%"))
                      ->orWhereHas('city', fn($q) => $q->where('name', 'like', "%{$search}%"))
                      ->orWhereHas('district', fn($q) => $q->where('name', 'like', "%{$search}%"))
                      ->orWhereHas('owner', fn($q) => $q->where('name', 'like', "%{$search}%"))
                      ->orWhereHas('partner', fn($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($activeFilter === 'active', fn($q) => $q->where('isActive', true))
            ->when($activeFilter === 'inactive', fn($q) => $q->where('isActive', false))
            ->when($deletedFilter === 'with', fn($q) => $q->withTrashed())
            ->when($deletedFilter === 'only', fn($q) => $q->onlyTrashed())
            ->when($typeFilter, fn($q, $typeId) => $q->where('type_id', $typeId))
            ->when($categoryFilter, fn($q, $categoryId) => $q->where('category_id', $categoryId))
            ->when($statusFilter, fn($q, $status) => $q->where('status', $status))
            ->when($adStatusFilter === 'with_ads', fn($q) => $q->whereHas('ads'))
            ->when($adStatusFilter === 'without_ads', fn($q) => $q->whereDoesntHave('ads'))
            ->when($stateFilter, fn($q, $stateId) => $q->where('state_id', $stateId))
            ->when($cityFilter, fn($q, $cityId) => $q->where('city_id', $cityId))
            ->when($districtFilter, fn($q, $districtId) => $q->where('district_id', $districtId));
    }
    


    public function scopeOfType($query, $typeName)
    {
        return $query->whereHas('type', function ($query) use ($typeName) {
            $query->where('name', $typeName);
        });
    }

    public function getAdStatusAttribute()
    {
        return $this->ads->isNotEmpty() ? 'İlanlı' : 'İlansız';
    }

//     public function scopeOfStatus($query, $status)
// {
//     return $query->where('status', $status);
// }
}
