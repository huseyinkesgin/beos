<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OveralExpense extends Model
{
    use ScopesTrait,SoftDeletes;

    protected $fillable = [
        'expense_type',
        'amount',
        'expense_date',
        'source',
    ];
}
