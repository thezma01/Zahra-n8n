<?php

use Illuminate\Support\Facades\Route;

Route::get('/review', function () {
    return view('review');
});