<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChoosePasswordResetMethodController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root to default locale
Route::redirect('/', '/'.config('app.locale'), 302);

// Group routes with {locale} prefix and SetLocale middleware
Route::group(['prefix' => '{locale}', 'middleware' => ['web', 'set_locale']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    // Password Reset Routes
    // Initial choice between email and SMS
    Route::get('password/choose-method', [ChoosePasswordResetMethodController::class, 'showChooseMethodForm'])->name('password.choose.method');
    Route::post('password/choose-method', [ChoosePasswordResetMethodController::class, 'chooseMethod'])->name('password.choose.method.post');

    // Email based password reset (standard Laravel)
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // SMS based password reset
    Route::get('password/phone', [ForgotPasswordController::class, 'showPhoneRequestForm'])->name('password.phone.request');
    Route::post('password/phone', [ForgotPasswordController::class, 'sendResetCodeSms'])->name('password.phone.send');

    // Password reset form (for both email and SMS tokens)
    // The token and identifier (email or phone_number) are passed via query string.
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Example of a protected route (requires authentication)
    // Route::middleware('auth')->group(function () {
    //     Route::get('/home', function () {
    //         return 'Welcome to your dashboard!';
    //     })->name('home');
    // });
});
