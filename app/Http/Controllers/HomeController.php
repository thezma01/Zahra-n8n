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
        $cakeOrder = new CakeOrder();
        $cakeOrder->cake_name = $request->input('cake_name');
        $cakeOrder->description = $request->input('description');
        $cakeOrder->price = $request->input('price');
        $cakeOrder->flavour = $request->input('flavour');
        $cakeOrder->size = $request->input('size');
        $cakeOrder->save();
        return redirect()->back()->with('success', 'Order created successfully.');
    }
}