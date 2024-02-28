<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'acount_name',
        'account_no',
        'bank_name',
        'opening_balance',
        'opening_date',
        'description',
    ];
}
