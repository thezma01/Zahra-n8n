<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CakeOrder;

class HomeController extends Controller
{
    /**
     * Display the home page with the cake order form.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Store a new cake order in the database.
     */
    public function storeOrder(Request $request)
    {
        $validatedData = $request->validate([
            'cake_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'flavour' => 'required|string|max:255',
            'size' => 'required|string|max:255',
        ]);

        CakeOrder::create($validatedData);

        return redirect()->back()->with('success', 'Your cake order has been placed successfully!');
    }
}

