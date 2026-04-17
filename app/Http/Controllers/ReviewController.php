namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Store the review in the database
        // For now, just dump the request data
        dd($request->all());
    }
}