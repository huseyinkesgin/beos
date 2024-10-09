<?php

namespace App\Models;

use App\Models\City;
use App\Traits\DateFormatAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function scopeFilter($query, $search, $activeFilter, $deletedFilter)
    {
        // Arama
        $query->when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
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
