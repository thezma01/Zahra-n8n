Route::post('/bags', [BagController::class, 'store']);
Route::get('/bags', [BagController::class, 'index']);
Route::get('/bags/{bag}', [BagController::class, 'show']);
Route::put('/bags/{bag}', [BagController::class, 'update']);
Route::delete('/bags/{bag}', [BagController::class, 'destroy']);
