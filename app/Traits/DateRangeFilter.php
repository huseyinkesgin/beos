<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateRangeFilter
{
    /**
     * Tarih aralığına göre sorgu filtresi
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $dateRange
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterByDateRange($query, $dateRange)
    {
        $now = Carbon::now();
        $startDate = null;
        $endDate = null;

        switch ($dateRange) {
            case 'last_week':
                $startDate = $now->clone()->subWeek()->startOfDay()->format('Y-m-d');
                $endDate = $now->clone()->endOfDay()->format('Y-m-d');
                break;
            case 'this_month':
                $startDate = $now->clone()->startOfMonth()->format('Y-m-d');
                $endDate = $now->clone()->endOfMonth()->format('Y-m-d');
                break;
            case 'last_month':
                $startDate = $now->clone()->subMonth()->startOfMonth()->format('Y-m-d');
                $endDate = $now->clone()->subMonth()->endOfMonth()->format('Y-m-d');
                break;
            case 'last_3_months':
                $startDate = $now->clone()->subDays(90)->startOfDay()->format('Y-m-d');
                $endDate = $now->clone()->endOfDay()->format('Y-m-d');
                break;
            case 'last_1_month':
                $startDate = $now->clone()->subDays(30)->startOfDay()->format('Y-m-d');
                $endDate = $now->clone()->endOfDay()->format('Y-m-d');
                break;
            case 'this_year':
                $startDate = $now->clone()->startOfYear()->format('Y-m-d');
                $endDate = $now->clone()->endOfYear()->format('Y-m-d');
                break;
            case 'last_year':
                $startDate = $now->clone()->subDays(365)->startOfDay()->format('Y-m-d');
                $endDate = $now->clone()->endOfDay()->format('Y-m-d');
                break;
            default:
                $startDate = null;
                $endDate = null;
        }

        if ($startDate && $endDate) {
            return $query->whereBetween('expense_date', [$startDate, $endDate]);
        }

        return $query;
    }
}
