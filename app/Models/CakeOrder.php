<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'cake_name',
        'description',
        'price',
        'flavour',
        'size',
    ];
}
