<?php

namespace App\Models;

use App\Traits\UuidTrait;
use App\Traits\ScopesTrait;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use ScopesTrait,SoftDeletes;



    protected $fillable = [

        'status',
        'price',
        'category_id',
        'type_id',
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
        'note',
        'isCredit',
        'isSwap',
        'deed_type',
        'property_no',
        'deposit'
    ];



    // İlişkiler
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function owner()
    {
        return $this->belongsTo(Customer::class, 'owner_customer_id');
    }

    public function partner()
    {
        return $this->belongsTo(Customer::class, 'partner_customer_id');
    }
}
