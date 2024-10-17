<?php

namespace App\Models;

use App\Traits\ScopesTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'type',
        'amount',
        'payment_date',
        'bill_date',
        'bill_no',
        'payment_method',
        'last_date',
        'is_recurring',
        'status',
    ];


    public static function calculateTotals()
{
    $currentYear = now()->year;
    $currentMonth = now()->month;

    return [
        'this_month_unpaid_total' => self::where('status', 'Ödenecek')
            ->whereYear('bill_date', $currentYear)
            ->whereMonth('bill_date', $currentMonth)
            ->sum('amount'),

        'this_month_paid_total' => self::where('status', 'Ödendi')
            ->whereYear('payment_date', $currentYear)
            ->whereMonth('payment_date', $currentMonth)
            ->sum('amount'),

        'this_year_paid_total' => self::where('status', 'Ödendi')
            ->whereYear('payment_date', $currentYear)
            ->sum('amount'),
    ];
}

    public function scopeFilter($query, $search, $deletedFilter)
    {
        // Arama
        $query->when($search, function ($query) use ($search) {
            $query->where('type', 'like', '%'.$search.'%');
        });

        // Silinmiş kayıt filtreleme
        $query->trashed($deletedFilter);

        return $query;
    }

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }

    // bill_date için erişimci (Accessor)
    public function getBillDateAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }

    // last_date için erişimci (Accessor)
    public function getLastDateAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }

    // payment_date için erişimci (Accessor)
    public function getPaymentDateAttribute($value)
    {
        return Carbon::parse($value)->format('d.m.Y');
    }

    public function setBillNoAttribute($value)
    {
        $this->attributes['bill_no'] = strtoupper($value);
    }




}
