<?php

namespace App\Models;

use App\Traits\UuidTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Land extends Model
{
    use ScopesTrait,SoftDeletes;



    protected $fillable = [

        'portfolio_id',
        'zoning_status',
        'area_m2',
        'similar',
        'height_limit',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
