<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'job_title', 'hire_date', 'termination_date'];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class);
    }

 

    public function jobDetails()
    {
        return $this->hasOne(JobDetail::class);
    }
}
