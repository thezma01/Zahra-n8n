namespace App\Http\Controllers;

use App\Http\Requests\BagRequest;
use App\Models\Bag;
use Illuminate\Http\JsonResponse;

class BagController extends Controller
{
    public function store(BagRequest $request): JsonResponse
    {
        $bag = Bag::create($request->validated());

        return response()->json([
            'message' => 'Bag created successfully',
            'data' => $bag,
        ], 201);
    }

    public function index(): JsonResponse
    {
        $bags = Bag::all();

        return response()->json([
            'message' => 'Bags retrieved successfully',
            'data' => $bags,
        ], 200);
    }

    public function show(Bag $bag): JsonResponse
    {
        return response()->json([
            'message' => 'Bag retrieved successfully',
            'data' => $bag,
        ], 200);
    }

    public function update(BagRequest $request, Bag $bag): JsonResponse
    {
        $bag->update($request->validated());

        return response()->json([
            'message' => 'Bag updated successfully',
            'data' => $bag,
        ], 200);
    }

    public function destroy(Bag $bag): JsonResponse
    {
        $bag->delete();

        return response()->json([
            'message' => 'Bag deleted successfully',
        ], 200);
    }
}
