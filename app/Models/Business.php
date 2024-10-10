<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends BaseModel
{
    protected $fillable = [
        'uuid',
        'price',
        'land_area_m2',
        'open_area',
        'closed_area',
        'floor_count',
        'floor_level',
        'electricity_power',
        'building_year',
        'is_factory',
        'is_warehouse',
        'is_store',
        'is_furnished',
        'loanable',
        'deed_type',
        'property_no',
        'state_id',
        'city_id',
        'district_id',
        'lot',
        'parcel',
        'description',
        'portfolio_no',
        'advisor',
        'partner_customer_id',
        'owner_customer_id',
        'isActive',
        'note'
    ];

}
