<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes;

    // Varsayılan özellikler

    protected $keyType = 'string'; // UUID string olarak tanımlı
    public $incrementing = false; // UUID için auto-increment devre dışı

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // UUID oluşturma
            }
        });
    }



    // Aktif kayıtlar için scope
    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }

    // Pasif kayıtlar için scope
    public function scopePassive($query)
    {
        return $query->where('isActive', false);
    }


     // Soft delete (silinenler) filtreleme scope'u
    public function scopeTrashed($query, $trashed)
    {
        if ($trashed === 'with') {
            return $query->withTrashed();
        } elseif ($trashed === 'only') {
            return $query->onlyTrashed();
        }
        return $query;
    }


}
