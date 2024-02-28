<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bank_id',
        'transaction_type',
        'transaction_date',
        'amount',
        'details',
    ];
}
