<?php

namespace App\Models;

use App\Models\Personnel;
use App\Traits\ScopesTrait;
use App\Traits\DateRangeFilter;
use App\Models\PersonnelExpense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonnelBalance extends Model
{
    use ScopesTrait,SoftDeletes,DateRangeFilter;

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

    public static function calculateBalance($personnel_id)
    {
        // İlgili personelin tüm nakit girişlerini ve çıkışlarını alıyoruz
        $totalIn = static::where('personnel_id', $personnel_id)->sum('cash_in');
        $totalOut = static::where('personnel_id', $personnel_id)->sum('cash_out');

        // Nakit harcamaları toplamını alıyoruz (PersonnelExpense modelindeki "Nakit" ödemeleri)
        $totalCashExpenses = PersonnelExpense::getTotalCashExpenses($personnel_id);

        // Mevcut balance'ı hesaplıyoruz
        return $totalIn - $totalOut - $totalCashExpenses;
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
    public function scopeFilter($query, $search, $deletedFilter, $personnelId = null)
    {
        $query->when($search, function ($query) use ($search) {
            $query->whereHas('personnel', function ($q) use ($search) {
                $q->where('first_name', 'like', '%'.$search.'%')
                  ->orWhere('last_name', 'like', '%'.$search.'%');
            });
        });

        $query->when($personnelId, function ($query) use ($personnelId) {
            $query->where('personnel_id', $personnelId);
        });

        $query->when($deletedFilter === 'only', function ($query) {
            $query->onlyTrashed();
        })->when($deletedFilter === 'with', function ($query) {
            $query->withTrashed();
        });

        return $query;
    }


}
