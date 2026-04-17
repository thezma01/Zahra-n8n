use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BagController;

Route::post('/services', [BagController::class, 'store']);
Route::get('/services', [BagController::class, 'index']);
Route::get('/services/{id}', [BagController::class, 'show']);
Route::put('/services/{id}', [BagController::class, 'update']);
Route::delete('/services/{id}', [BagController::class, 'destroy']);
