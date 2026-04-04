<?php

use Illuminate\Support\Facades\Route;

Route::get('/products', function () {
    return view('products');
});