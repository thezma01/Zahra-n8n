<?php

use App\Http\Controllers\HomeDecorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned the "api" middleware group. Make sure to add proper
| middleware for authentication as needed.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Home Decor Accessories Routes
|--------------------------------------------------------------------------
*/
Route::prefix('home-decor-accessories')->group(function () {

    // GET /api/home-decor-accessories — List all accessories
    Route::get('/', [HomeDecorController::class, 'index']);

    // GET /api/home-decor-accessories/{id} — Get a single accessory
    Route::get('/{id}', [HomeDecorController::class, 'show']);

    // POST /api/home-decor-accessories/insert — Create a new accessory
    Route::post('/insert', [HomeDecorController::class, 'insert']);

    // PUT /api/home-decor-accessories/update/{id} — Update an accessory
    Route::put('/update/{id}', [HomeDecorController::class, 'update']);

    // PATCH /api/home-decor-accessories/update/{id} — Partial update
    Route::patch('/update/{id}', [HomeDecorController::class, 'update']);

    // DELETE /api/home-decor-accessories/delete/{id} — Delete an accessory
    Route::delete('/delete/{id}', [HomeDecorController::class, 'delete']);
});