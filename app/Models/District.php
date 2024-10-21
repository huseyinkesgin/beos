<?php

namespace App\Models;

use App\Models\City;
use App\Models\State;
use App\Models\Portfolio;
use App\Traits\UuidTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [

        'state_id',
        'city_id',
        'name',
        'note',
        'isActive'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function portfolios()
{
    return $this->hasMany(Portfolio::class);
}

    public function scopeFilter($query, $search, $activeFilter, $deletedFilter)
    {
       // Arama
    $query->when($search, function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%')
            ->orWhereHas('state', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('city', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    });

        // Aktif/Pasif filtreleme
        $query->when($activeFilter !== 'all', function ($query) use ($activeFilter) {
            $query->where('isActive', $activeFilter === 'active');
        });

        // Silinmiş kayıt filtreleme
        $query->trashed($deletedFilter);

        return $query;
    }

}
