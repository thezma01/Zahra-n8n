<?php

namespace App\Http\Controllers;

use App\Models\CakeOrder;
use Illuminate\Http\Request;

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
     * Store a newly created cake order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cake_name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'flavour' => 'required|string|max:255',
            'size' => 'required|string|in:Small,Medium,Large',
        ]);

        CakeOrder::create($validated);

        return redirect('/')->with('success', 'Your cake order has been placed successfully!');
    }
}
