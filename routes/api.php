<?php

use App\Http\Controllers\Api\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Staff API routes
// This will register a full set of RESTful routes for the StaffController:
// GET /api/staff (index) - Get all staff
// POST /api/staff (store) - Create new staff
// GET /api/staff/{staff} (show) - Get a single staff member
// PUT/PATCH /api/staff/{staff} (update) - Update a staff member
// DELETE /api/staff/{staff} (destroy) - Delete a staff member
Route::apiResource('staff', StaffController::class);