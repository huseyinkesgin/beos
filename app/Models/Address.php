<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address_line1', 'address_line2', 'city', 'state', 'postal_code', 'country'];

    public function addressable()
    {
        return $this->morphTo();
    }
}
