<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetInTouchController;

Route::get('/get-in-touch', [GetInTouchController::class, 'index']);
Route::post('/get-in-touch', [GetInTouchController::class, 'store']);