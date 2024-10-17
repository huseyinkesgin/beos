<?php

namespace App\Models;

use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use ScopesTrait,SoftDeletes;


    protected $fillable = ['state_id','city_id','district_id', 'address_line1', 'address_line2',  'postal_code','isActive','is_default','addressable_type','addressable_id'];

    public function addressable()
    {
        return $this->morphTo();
    }
}
