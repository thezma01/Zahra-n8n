// Import the necessary namespace
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestimonialController;

// Define the route for the testimonials page
Route::get('/testimonials', [TestimonialController::class, 'index']);
