<?php

namespace App\Models;

use App\Models\Personnel;
use App\Traits\ScopesTrait;
use App\Models\PersonnelExpense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonnelBalance extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'personnel_id',
        'cash_in',
        'cash_out',
        'balance',
    ];
    // İlişki: Bakiye bilgisi, belirli bir personele aittir
    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }

    // Bakiye hesaplama işlemi, nakit giriş ve çıkışlara göre balance hesaplanacak
    public static function calculateBalance($personnel_id)
    {
        // İlgili personelin tüm nakit giriş ve çıkışlarını alıyoruz
        $totalIn = static::where('personnel_id', $personnel_id)->sum('cash_in');
        $totalOut = static::where('personnel_id', $personnel_id)->sum('cash_out');

        // Mevcut balance'ı hesaplıyoruz
        return $totalIn - $totalOut;
    }

    // Yeni nakit girişi ya da çıkışı olduğunda balance otomatik hesaplanacak
    public static function updateBalance($personnel_id)
    {
        $balance = static::calculateBalance($personnel_id);

        // Personelin en son kaydını güncelle
        static::where('personnel_id', $personnel_id)
            ->latest()
            ->first()
            ->update(['balance' => $balance]);
    }
}
