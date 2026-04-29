<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\StickyNoteController;
// use App\Http\Controllers\HomeDecorController;
use App\Http\Controllers\API\ClothController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ShipmentController;
use App\Http\Controllers\Api\StudentController;
// use App\Http\Controllers\BagController;

// Route::post('/notes', [StickyNoteController::class, 'store']);
// Route::get('/notes', [StickyNoteController::class, 'index']);
// Route::get('/notes/{note}', [StickyNoteController::class, 'show']);
// Route::put('/notes/{note}', [StickyNoteController::class, 'update']);
// Route::delete('/notes/{note}', [StickyNoteController::class, 'destroy']);



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make sure to add proper
| middleware for authentication as needed.
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/*
|--------------------------------------------------------------------------
| Home Decor Accessories Routes
|--------------------------------------------------------------------------
*/
// Route::prefix('home-decor-accessories')->group(function () {

//     // GET /api/home-decor-accessories — List all accessories
//     Route::get('/', [HomeDecorController::class, 'index']);

//     // GET /api/home-decor-accessories/{id} — Get a single accessory
//     Route::get('/{id}', [HomeDecorController::class, 'show']);

//     // POST /api/home-decor-accessories/insert — Create a new accessory
//     Route::post('/insert', [HomeDecorController::class, 'insert']);

//     // PUT /api/home-decor-accessories/update/{id} — Update an accessory
//     Route::put('/update/{id}', [HomeDecorController::class, 'update']);

//     // PATCH /api/home-decor-accessories/update/{id} — Partial update
//     Route::patch('/update/{id}', [HomeDecorController::class, 'update']);

//     // DELETE /api/home-decor-accessories/delete/{id} — Delete an accessory
//     Route::delete('/delete/{id}', [HomeDecorController::class, 'delete']);
// });

// Route::post('/bags', [BagController::class, 'store']);
// Route::get('/bags', [BagController::class, 'index']);
// Route::get('/bags/{id}', [BagController::class, 'show']);
// Route::put('/bags/{id}', [BagController::class, 'update']);
// Route::delete('/bags/{id}', [BagController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Cloth API Routes
|--------------------------------------------------------------------------
*/
Route::apiResource('cloths', ClothController::class);

/*
|--------------------------------------------------------------------------
| Customer API Routes
|--------------------------------------------------------------------------
*/
Route::apiResource('customers', CustomerController::class);
Route::get('customers-shipment-statuses', [CustomerController::class, 'getShipmentStatuses']);

/*
|--------------------------------------------------------------------------
| Shipment API Routes
|--------------------------------------------------------------------------
*/
Route::apiResource('shipments', ShipmentController::class);

/*
|--------------------------------------------------------------------------
| Student API Routes
|--------------------------------------------------------------------------
*/
Route::apiResource('students', StudentController::class);
