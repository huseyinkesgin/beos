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

    protected $guarded = [];

    // protected $fillable = [

    //     'portfolio_id',
    //     'zoning_status',
    //     'area_m2',
    //     'similar',
    //     'height_limit',
    // ];



    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
