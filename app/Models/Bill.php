<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ScopesTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use ScopesTrait,SoftDeletes;


    protected $dates = ['due_date'];

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




    public function setBillNoAttribute($value)
    {
        $this->attributes['bill_no'] = strtoupper($value);
    }






}
