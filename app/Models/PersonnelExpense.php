<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonnelExpense extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'personnel_id',
        'expense_type',
        'note',
        'amount',
        'payment_method',
        'expense_date',
    ];

    // Personel ilişkisi
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }

    // Harcama tarih formatını alır
    public function getExpenseDateAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }

    // Harcama tarihini veritabanına uygun formatta kaydeder
    public function setExpenseDateAttribute($value)
    {
        $this->attributes['expense_date'] = Carbon::parse($value)->format('Y-m-d');
    }
}
