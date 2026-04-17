namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $service = Service::create($request->all());

        return response()->json([
            'message' => 'Service created successfully',
            'data' => new ServiceResource($service),
        ], 201);
    }
}
