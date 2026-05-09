<?php

namespace App\Http\Controllers;

use App\Models\CakeOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Store a newly created cake order in storage.
     */
    public function storeCakeOrder(Request $request)
    {
        $validated = $request->validate([
            'cake_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'flavour' => 'required|string|max:255',
            'size' => 'required|string|max:255',
        ]);

        CakeOrder::create($validated);

        return redirect()->back()->with('success', 'Your cake order has been placed successfully!');
    }
}

