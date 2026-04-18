namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json(['services' => $services], 200);
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return response()->json(['message' => 'Service created successfully', 'service' => $service], 201);
    }

    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        return response()->json(['service' => $service], 200);
    }

    public function update(UpdateServiceRequest $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        $service->update($request->validated());
        return response()->json(['message' => 'Service updated successfully', 'service' => $service], 200);
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        $service->delete();
        return response()->json(['message' => 'Service deleted successfully'], 200);
    }
}
