<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GetInTouch;

class GetInTouchController extends Controller
{
    public function index()
    {
        return view('get-in-touch');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email',
            'message' => 'required|regex:/^[a-zA-Z0-9 ]+$/',
        ]);

        GetInTouch::create($request->all());

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}