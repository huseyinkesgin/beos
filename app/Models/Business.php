<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Portfolio;
use App\Traits\UuidTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{

    use ScopesTrait,SoftDeletes;


    protected $fillable = [

        'portfolio_id',
        'area_m2',
        'open_area',
        'closed_area',
        'business_area',
        'office_area ',
        'floor_count',
        'floor_level',
        'electricity_power',
        'building_year',
        'heating_type',
        'building_condition',
        'usage_status',
        'ground_analysis',
        'height',
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }


}
