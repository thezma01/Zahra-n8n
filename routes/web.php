use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialController;

Route::get('/testimonials', [TestimonialController::class, 'index']);
