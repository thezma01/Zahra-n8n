namespace App\Http\Controllers;

use App\Http\Requests\BagRequest;
use App\Models\Bag;
use Illuminate\Http\Request;

class BagController extends Controller
{
    public function store(BagRequest $request)
    {
        $bag = Bag::create($request->validated());
        return response()->json(['message' => 'Bag created successfully', 'data' => $bag], 201);
    }

    public function index()
    {
        $bags = Bag::all();
        return response()->json($bags);
    }

    public function show(Bag $bag)
    {
        return response()->json($bag);
    }

    public function update(BagRequest $request, Bag $bag)
    {
        $bag->update($request->validated());
        return response()->json(['message' => 'Bag updated successfully', 'data' => $bag]);
    }

    public function destroy(Bag $bag)
    {
        $bag->delete();
        return response()->json(['message' => 'Bag deleted successfully']);
    }
}
