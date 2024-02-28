<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowroomWarehouse extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'type',
        'address',
        'mobile',
    ];
}
