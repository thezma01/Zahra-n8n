<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'shipment_status' => ['required', 'string', Rule::in(['Pending', 'In Transit', 'Delivered', 'Cancelled'])],
            'delivery_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Customer $customer): JsonResponse
    {
        $validated = $request->validate([
            'customer_name' => ['sometimes', 'required', 'string', 'max:100'],
            'shipment_status' => ['sometimes', 'required', 'string', Rule::in(['Pending', 'In Transit', 'Delivered', 'Cancelled'])],
            'delivery_date' => ['sometimes', 'required', 'date', 'after_or_equal:today'],
        ]);

        $customer->update($validated);
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}

