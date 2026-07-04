<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer', // Validation for existence in 'products' table would typically be 'exists:products,id'
            'customer_name' => 'required|string|max:255',
            'order_summary' => 'required|string',
            'date' => 'required|date',
            'order_id' => 'nullable|string|unique:orders,order_id|max:255', // Allows manual entry. If not provided, it will be stored as NULL.
        ]);
        
        $order = Order::create($validated);

        return response()->json([
            'message' => 'Order created successfully.',
            'order' => $order,
        ], 201);
    }
}
