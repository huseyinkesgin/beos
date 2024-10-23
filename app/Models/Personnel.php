<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Address;
use App\Traits\ScopesTrait;
use App\Models\PersonnelBalance;
use App\Models\PersonnelExpense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'job_title',
        'hire_date',
        'termination_date'
    ];

    // Personel harcamaları ilişkisi
    public function expenses()
    {
        return $this->hasMany(PersonnelExpense::class);
    }

    public function balance()
    {
        return $this->hasMany(PersonnelBalance::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }


    public function scopeFilter($query, $search, $activeFilter, $deletedFilter)
    {
       // Arama
    $query->when($search, function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%')

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

    // Danışmanları getirmek için bir scope tanımlıyoruz
    public function scopeAdvisors($query)
    {
        return $query->where('job_title', 'Danışman')->where('isActive', true);
    }
    // Ad soyad birleştirici
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // İK Başlangıç tarihini insana okunur şekilde döndürür
    public function getHireDateForHumansAttribute()
    {
        return Carbon::parse($this->hire_date)->diffForHumans();
    }
}
