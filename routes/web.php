<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestimonialController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
