<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'expense_type_id',
        'description',
        'expense_date',
        'expense_amount',
        'payment_type',
        'expense_location',
    ];
}
