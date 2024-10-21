<?php

namespace App\Models;

use App\Models\City;
use App\Models\Portfolio;
use App\Traits\UuidTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [

        'name',
        'isActive',
        'note',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function scopeFilter($query, $search, $activeFilter, $deletedFilter)
    {
        $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        });

        $query->when($activeFilter !== 'all', function ($query) use ($activeFilter) {
            $query->where('isActive', $activeFilter === 'active');
        });

        $query->trashed($deletedFilter);

        return $query;
    }


}
