namespace App\Http\Controllers;

use App\Models\Bag;
use Illuminate\Http\Request;

class BagController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'price' => 'required|numeric',
            'color' => 'required',
        ]);

        $bag = Bag::create($request->all());

        return response()->json([
            'message' => 'Bag created successfully',
            'data' => $bag,
        ], 201);
    }

    public function index()
    {
        $bags = Bag::all();

        return response()->json([
            'message' => 'Bags retrieved successfully',
            'data' => $bags,
        ], 200);
    }

    public function show($id)
    {
        $bag = Bag::find($id);

        if (!$bag) {
            return response()->json([
                'message' => 'Bag not found',
            ], 404);
        }

        return response()->json([
            'message' => 'Bag retrieved successfully',
            'data' => $bag,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $bag = Bag::find($id);

        if (!$bag) {
            return response()->json([
                'message' => 'Bag not found',
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|required',
            'size' => 'sometimes|required',
            'price' => 'sometimes|required|numeric',
            'color' => 'sometimes|required',
        ]);

        $bag->update($request->all());

        return response()->json([
            'message' => 'Bag updated successfully',
            'data' => $bag,
        ], 200);
    }

    public function destroy($id)
    {
        $bag = Bag::find($id);

        if (!$bag) {
            return response()->json([
                'message' => 'Bag not found',
            ], 404);
        }

        $bag->delete();

        return response()->json([
            'message' => 'Bag deleted successfully',
        ], 200);
    }
}
