<?php

namespace App\Http\Controllers;

use App\Models\CakeOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try {
            $validatedData = $request->validate([
                'cake_name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'flavour' => 'required|string|max:255',
                'size' => 'required|string|in:Small,Medium,Large',
            ]);

            CakeOrder::create($validatedData);

            return redirect()->route('home')->with('success', 'Cake order placed successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to place order. ' . $e->getMessage())->withInput();
        }
    }
}

