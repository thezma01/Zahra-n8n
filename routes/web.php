<!-- web.php -->

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/products', function () {
    $products = [
        ['name' => 'Product 1', 'price' => 10.99, 'quantity' => 5],
        ['name' => 'Product 2', 'price' => 9.99, 'quantity' => 10],
        ['name' => 'Product 3', 'price' => 12.99, 'quantity' => 7],
    ];

    return view('products', compact('products'));
});