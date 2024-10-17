<?php

namespace App\Models;

use App\Models\Personnel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonnelBalance extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'personnel_id',
        'initial_balance',
        'current_balance',
    ];

    // İlişki: Bakiye bilgisi, belirli bir personele aittir
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
