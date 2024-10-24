<?php

namespace App\Models;

use App\Models\Portfolio;
use App\Traits\ScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioMedia extends Model
{
    use SoftDeletes,ScopesTrait;

    protected $fillable = ['portfolio_id', 'type', 'file_path'];

    // Portföy ile ilişki
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
