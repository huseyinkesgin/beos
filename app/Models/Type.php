<?php

namespace App\Models;

use App\Models\Category;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends BaseModel
{
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'form_path',
        'isActive',
        'note'
    ];


    public function Category()
    {
        return $this->belongsTo(Category::class);
    }


    public function scopeFilter($query, $search = null, $activeFilter = 'all', $deletedFilter = 'without')
    {
        // Search: District name or State name
        if (! empty($search)) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhereHas('category', function ($query) use ($search) {
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

