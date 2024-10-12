<?php

namespace App\Models;

use App\Models\State;
use App\Models\District;
use App\Models\BaseModel;
use App\Models\Portfolio;
use App\Traits\UuidTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [

        'state_id',  // Foreign key
        'name',
        'is_active',
        'note'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function scopeFilter($query, $search = null, $activeFilter = 'all', $deletedFilter = 'without')
    {
        // Search: District name or State name
        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhereHas('state', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                });
        }

        // Active/Inactive filtering
        if ($activeFilter !== 'all') {
            $isActive = $activeFilter == 'active';
            $query->where('isActive', $isActive);
        }

        // Soft delete filtering
        if ($deletedFilter == 'with') {
            $query->withTrashed();
        } elseif ($deletedFilter == 'only') {
            $query->onlyTrashed();
        }

        return $query;
    }

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }
}
