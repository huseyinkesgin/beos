<?php

namespace App\Models;

use App\Models\City;
use App\Models\Type;
use App\Models\State;
use App\Models\Category;
use App\Models\Customer;
use App\Models\District;
use App\Models\BaseModel;

class Portfolio extends BaseModel
{
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
