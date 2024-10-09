<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends BaseModel
{
    protected $fillable = [
        'customer_type', // varsayılan olarak Bireysel
        'category',      // mal sahibi, emlakçı, komisyoncu, referans, alıcı
        'name',
        'company_name',
        'tax_office',
        'tax_no',
        'phone',
        'email',
        'company',
        'address',
        'isActive',      // BaseModel'den gelen aktiflik alanı
        'note',
    ];
}
