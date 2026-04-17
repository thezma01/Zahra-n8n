Route::post('/bags', [BagController::class, 'store']);
Route::get('/bags', [BagController::class, 'index']);
Route::get('/bags/{id}', [BagController::class, 'show']);
Route::put('/bags/{id}', [BagController::class, 'update']);
Route::delete('/bags/{id}', [BagController::class, 'destroy']);
