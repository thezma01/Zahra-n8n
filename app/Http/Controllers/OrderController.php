<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'nullable|string|max:255|unique:orders,order_id',
            'product_id' => 'required|integer|exists:products,id', // Assumes a 'products' table with an 'id' column
            'customer_name' => 'required|string|max:255',
            'order_summary' => 'nullable|string',
            'date' => 'required|date',
        ]);

        // If order_id is not provided, generate a UUID
        if (!isset($validatedData['order_id'])) {
            $validatedData['order_id'] = (string) Str::uuid();
        }

        $order = Order::create($validatedData);

        return response()->json([
            'message' => 'Order created successfully.',
            'order' => $order
        ], Response::HTTP_CREATED);
    }
}

