<?php

namespace App\Traits;

trait ScopesTrait
{
    // Scope for active records
    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }

    // Scope for passive records
    public function scopePassive($query)
    {
        return $query->where('isActive', false);
    }

    // Scope for soft-deleted records
    public function scopeTrashed($query, $trashed)
    {
        if ($trashed === 'with') {
            return $query->withTrashed();
        } elseif ($trashed === 'only') {
            return $query->onlyTrashed();
        }
        return $query;
    }

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }
}
