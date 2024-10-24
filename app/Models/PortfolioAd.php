<?php

namespace App\Models;

use App\Models\Portfolio;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioAd extends Model
{
    use SoftDeletes,ScopesTrait;

    protected $fillable = [
        'portfolio_id',
        'site_name',
        'ads_id',
        'ads_link',
        'status',
    ];

    // Portfolio ile ilişkisi
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
