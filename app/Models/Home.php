<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends BaseModel
{
    protected $fillable = [
        'uuid',
        'price',
        'area_m2',
        'room_count',
        'floor_level',
        'total_floors',
        'is_furnished',
        'isCredit',
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
