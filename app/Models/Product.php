<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'code',
        'barcode_symbology',
        'category_id',
        'brand_id',
        'unit_id',
        'price',
        'minimum_stock',
        'quantity',
        'image',
        'is_active',
    ];
}
