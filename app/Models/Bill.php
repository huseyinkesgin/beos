<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use ScopesTrait, SoftDeletes, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';


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

    protected $casts = [
        'bill_date' => 'date',
        'payment_date' => 'date',
        'last_date' => 'date',
        'amount' => 'decimal:2',
        'is_recurring' => 'boolean',
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

    // Tarih formatı mutator'ları - formdan gelen string'leri işle
    public function setBillDateAttribute($value)
    {
        if ($value && is_string($value)) {
            try {
                // Eğer Y-m-d formatındaysa direkt kullan (backend formatı)
                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                    $this->attributes['bill_date'] = $value;
                }
                // Eğer d.m.Y formatındaysa (Türkiye formatı) çevir
                elseif (preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $value)) {
                    $this->attributes['bill_date'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
                }
                else {
                    $this->attributes['bill_date'] = $value;
                }
            } catch (\Exception $e) {
                $this->attributes['bill_date'] = $value;
            }
        } else {
            $this->attributes['bill_date'] = $value;
        }
    }

    public function setPaymentDateAttribute($value)
    {
        if ($value && is_string($value)) {
            try {
                // Eğer Y-m-d formatındaysa direkt kullan (backend formatı)
                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                    $this->attributes['payment_date'] = $value;
                }
                // Eğer d.m.Y formatındaysa (Türkiye formatı) çevir
                elseif (preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $value)) {
                    $this->attributes['payment_date'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
                }
                else {
                    $this->attributes['payment_date'] = $value;
                }
            } catch (\Exception $e) {
                $this->attributes['payment_date'] = $value;
            }
        } else {
            $this->attributes['payment_date'] = $value;
        }
    }

    public function setLastDateAttribute($value)
    {
        if ($value && is_string($value)) {
            try {
                // Eğer Y-m-d formatındaysa direkt kullan (backend formatı)
                if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                    $this->attributes['last_date'] = $value;
                }
                // Eğer d.m.Y formatındaysa (Türkiye formatı) çevir
                elseif (preg_match('/^\d{2}\.\d{2}\.\d{4}$/', $value)) {
                    $this->attributes['last_date'] = Carbon::createFromFormat('d.m.Y', $value)->format('Y-m-d');
                }
                else {
                    $this->attributes['last_date'] = $value;
                }
            } catch (\Exception $e) {
                $this->attributes['last_date'] = $value;
            }
        } else {
            $this->attributes['last_date'] = $value;
        }
    }

    // Tarih formatı accessor'ları - gösterim için Türkiye formatında döndür
    public function getBillDateFormattedAttribute()
    {
        return $this->bill_date ? Carbon::parse($this->bill_date)->format('d.m.Y') : null;
    }

    public function getPaymentDateFormattedAttribute()
    {
        return $this->payment_date ? Carbon::parse($this->payment_date)->format('d.m.Y') : null;
    }

    public function getLastDateFormattedAttribute()
    {
        return $this->last_date ? Carbon::parse($this->last_date)->format('d.m.Y') : null;
    }






}
