<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/webpage', [HomeController::class, 'index'])->name('home');
Route::post('/order', [HomeController::class, 'store'])->name('cake.order');

