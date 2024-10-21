<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ScopesTrait;
use App\Traits\DateRangeFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonnelExpense extends Model
{
    use ScopesTrait,SoftDeletes,DateRangeFilter;

    protected $fillable = [
        'personnel_id',
        'expense_type',
        'note',
        'amount',
        'payment_method',
        'expense_date',
    ];

    public static function getTotalCashExpenses($personnel_id)
{
    return static::where('personnel_id', $personnel_id)
        ->where('payment_method', 'Nakit')
        ->sum('amount');
}


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

    public function scopeFilter($query, $search, $deletedFilter, $startDate = null, $endDate = null, $paymentMethod = null)
    {
        // Arama işlemi: personnel_id, expense_type, note ve personel adı üzerinden
        $query->when($search, function ($query) use ($search) {
            $query->where('expense_type', 'like', '%' . $search . '%')
                ->orWhere('note', 'like', '%' . $search . '%')
                ->orWhereHas('personnel', function ($query) use ($search) {
                    $query->where('first_name', 'like', '%' . $search . '%')
                          ->orWhere('last_name', 'like', '%' . $search . '%');
                });
        });

        // Silinmiş kayıt filtreleme (deleted_at kullanarak)
        $query->when($deletedFilter == 'only', function ($query) {
            $query->onlyTrashed();
        })
        ->when($deletedFilter == 'with', function ($query) {
            $query->withTrashed();
        });

        // Tarih aralığı filtresi
        $query->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('expense_date', [$startDate, $endDate]);
        });

        // Ödeme yöntemi filtresi (Nakit, Kredi Kartı, vb.)
        $query->when($paymentMethod, function ($query) use ($paymentMethod) {
            $query->where('payment_method', $paymentMethod);
        });

        return $query;
    }

}
