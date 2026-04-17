use App\Http\Controllers\BagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/services', [BagController::class, 'store']);
Route::get('/services', [BagController::class, 'index']);
Route::get('/services/{bag}', [BagController::class, 'show']);
Route::put('/services/{bag}', [BagController::class, 'update']);
Route::delete('/services/{bag}', [BagController::class, 'destroy']);
