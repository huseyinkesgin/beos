<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Portfolio;

class Category extends BaseModel
{
    protected $fillable = [
        'id',
        'name',
        'isActive',
        'note',
    ];

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function scopeFilter($query, $search, $activeFilter, $deletedFilter)
    {
        // Arama
        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        // Filter by active status
        if ($activeFilter !== 'all') {
            $isActive = $activeFilter == 'active';
            $query->where('isActive', $isActive);
        }

        // Silinmiş kayıt filtreleme
        $query->trashed($deletedFilter);

        return $query;
    }

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }
}
