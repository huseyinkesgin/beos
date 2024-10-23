<?php

namespace App\Models;

use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioGallery extends Model
{
    use HasFactory;

    protected $fillable = ['portfolio_id', 'file_path', 'order'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function getFeaturedImageAttribute()
{
    return $this->where('portfolio_id', $this->portfolio_id)
                ->where('featured', true)
                ->first() ?? $this->where('portfolio_id', $this->portfolio_id)
                ->orderBy('order', 'asc')
                ->first();
}
}
