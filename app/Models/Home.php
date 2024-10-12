<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Portfolio;
use App\Traits\UuidTrait;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [

        'portfolio_id',
        'area_m2',
        'room_count',
        'building_years',
        'floor_level',
        'total_floors',
        'heating_type',
        'bathroom_count',
        'isFurnished',
        'isBalcon',
        'isElevator',
        'parking',
        'usage_status'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

}
