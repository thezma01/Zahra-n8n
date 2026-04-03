use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::post('/products', [ProductController::class, 'create']);
Route::get('/products', [ProductController::class, 'getAll']);