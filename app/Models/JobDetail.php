<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetail extends Model
{
    use HasFactory;

    protected $fillable = ['personnel_id', 'department', 'position'];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
