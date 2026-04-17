use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StickyNoteController;

Route::post('/notes', [StickyNoteController::class, 'store']);
Route::get('/notes', [StickyNoteController::class, 'index']);
Route::get('/notes/{note}', [StickyNoteController::class, 'show']);
Route::put('/notes/{note}', [StickyNoteController::class, 'update']);
Route::delete('/notes/{note}', [StickyNoteController::class, 'destroy']);
