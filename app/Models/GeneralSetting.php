<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'shop_name',
        'email',
        'mobile',
        'address',
        'logo',
        'favicon',
        'currency',
        'currency_symbol',
    ];
}
