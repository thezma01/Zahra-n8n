// File: app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getData()
    {
        $products = Product::all();
        return response()->json([
            'message' => 'Products retrieved successfully',
            'data' => $products
        ], 200);
    }
}