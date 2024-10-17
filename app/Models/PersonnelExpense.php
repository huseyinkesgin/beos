<?php

namespace App\Models;

use App\Models\Personnel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonnelExpense extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'personnel_id',
        'expense_type',
        'amount',
        'payment_method',
    ];

    // İlişki: Bu harcamanın ait olduğu personel
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
