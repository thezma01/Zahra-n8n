<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/contact', [ContactController::class, 'index'])->name('contact');
// Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// ─── Authentication Routes (Guest Only) ───────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// ─── Protected Routes (Authenticated Only) ────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
