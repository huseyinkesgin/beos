<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Personnel;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonnelExpense extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'personnel_id',
        'expense_type',
        'note',
        'amount',
        'payment_method',
        'expense_date'
    ];

    // İlişki: Bu harcamanın ait olduğu personel
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }


     public function getExpenseDateAttribute($value)
     {
         return Carbon::parse($value)->format('d.m.Y');
     }

     public function setExpenseDateAttribute($value)
{
    $this->attributes['expense_date'] = Carbon::parse($value)->format('Y-m-d');
}

}
