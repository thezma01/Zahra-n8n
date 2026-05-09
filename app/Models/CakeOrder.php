<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CakeOrder extends Model
{
    protected $fillable = [
        'cake_name',
        'description',
        'price',
        'flavour',
        'size'
    ];
}