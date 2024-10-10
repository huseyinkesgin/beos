<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Land extends BaseModel
{
    protected $fillable = [
        'uuid',
        'price',
        'zoning_status',
        'area_m2',
        'similar',
        'height_limit',
        'loanable',
        'deed_type',
        'isSwap',
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
