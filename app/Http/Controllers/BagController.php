namespace App\Http\Controllers;

use App\Models\Bag;
use Illuminate\Http\Request;

class BagController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
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

        return response()->json($bags);
    }

    public function show($id)
    {
        $bag = Bag::find($id);

        if (!$bag) {
            return response()->json([
                'message' => 'Bag not found',
            ], 404);
        }

        return response()->json($bag);
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
            'name' => 'sometimes|required|string',
            'type' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string',
        ]);

        $bag->update($request->all());

        return response()->json([
            'message' => 'Bag updated successfully',
            'data' => $bag,
        ]);
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
        ]);
    }
}
