// Import the necessary namespace
namespace App\Http\Controllers;

// Define the TestimonialController class
class TestimonialController extends Controller
{
    // Define the index method
    public function index()
    {
        // Return the customer_feedback view
        return view('customer_feedback');
    }
}
