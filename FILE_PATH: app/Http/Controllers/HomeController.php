<?php

namespace App\Http\Controllers;

use App\Models\CakeOrder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'cake_name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'flavour' => 'required',
            'size' => 'required',
        ]);

        CakeOrder::create($request->all());

        return back()->with('success', 'Order created successfully!');
    }
}
