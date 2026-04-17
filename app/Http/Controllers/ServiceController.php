namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $service = Service::create($request->all());

        return response()->json([
            'message' => 'Service created successfully',
            'data' => new ServiceResource($service),
        ], 201);
    }

    public function index()
    {
        $services = Service::all();

        return ServiceResource::collection($services);
    }

    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'message' => 'Service not found',
            ], 404);
        }

        return new ServiceResource($service);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'message' => 'Service not found',
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|string',
            'type' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'description' => 'sometimes|string',
        ]);

        $service->update($request->all());

        return response()->json([
            'message' => 'Service updated successfully',
            'data' => new ServiceResource($service),
        ]);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'message' => 'Service not found',
            ], 404);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service deleted successfully',
        ]);
    }
}
