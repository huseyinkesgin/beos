<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelInformation extends Model
{
    use HasFactory;

    protected $fillable = ['personnel_id', 'identity_number', 'driving_license_number', 'birth_date', 'photo'];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
