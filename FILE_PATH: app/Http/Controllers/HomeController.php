namespace App\Http\Controllers;

use App\Models\CakeOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function createOrder(Request $request)
    {
        $order = new CakeOrder();
        $order->cake_name = $request->input('cake_name');
        $order->description = $request->input('description');
        $order->price = $request->input('price');
        $order->flavour = $request->input('flavour');
        $order->size = $request->input('size');
        $order->save();

        return redirect()->back()->with('success', 'Order created successfully!');
    }
}
