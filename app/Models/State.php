<?php

namespace App\Models;

class State extends BaseModel
{
    protected $fillable = [
        'id',
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
        // Arama
        $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        });

        // Aktif/Pasif filtreleme
        $query->when($activeFilter !== 'all', function ($query) use ($activeFilter) {
            $query->where('isActive', $activeFilter === 'active');
        });

        // Silinmiş kayıt filtreleme
        $query->trashed($deletedFilter);

        return $query;
    }

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }
}
