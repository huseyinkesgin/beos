<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ScopesTrait;
use App\Models\PersonnelBalance;
use App\Models\PersonnelExpense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personnel extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'job_title', 'hire_date', 'termination_date'];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class);
    }

     // İlişki: Personelin harcamaları
     public function expenses()
     {
         return $this->hasMany(PersonnelExpense::class);
     }

     // İlişki: Personelin nakit bakiyesi
     public function balance()
     {
         return $this->hasOne(PersonnelBalance::class);
     }



    public function jobDetails()
    {
        return $this->hasOne(JobDetail::class);
    }

    public function scopeFilter($query, $search = null, $activeFilter = 'all', $deletedFilter = 'without', $customerType = '', $category = '')
    {
        $query->when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%');
            });
        });

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

    public function getHireDateForHumansAttribute()
    {
        Carbon::setLocale('tr');
        return Carbon::parse($this->hire_date)->diffForHumans(['parts' => 2, 'join' => true]);
    }


    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
