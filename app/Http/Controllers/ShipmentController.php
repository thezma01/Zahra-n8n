<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipments = Shipment::all();
        return response()->json($shipments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'shipment_status' => ['required', 'string', Rule::in(['Pending', 'Shipped', 'In Transit', 'Delivered'])],
            'delivery_date' => 'required|date|after_or_equal:today',
        ]);

        $shipment = Shipment::create($validatedData);
        return response()->json($shipment, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $shipment = Shipment::find($id);

        if (!$shipment) {
            return response()->json(['message' => 'Shipment not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($shipment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shipment = Shipment::find($id);

        if (!$shipment) {
            return response()->json(['message' => 'Shipment not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'order_id' => 'sometimes|required|integer',
            'customer_id' => 'sometimes|required|integer',
            'shipment_status' => ['sometimes', 'required', 'string', Rule::in(['Pending', 'Shipped', 'In Transit', 'Delivered'])],
            'delivery_date' => 'sometimes|required|date|after_or_equal:today',
        ]);

        $shipment->update($validatedData);
        return response()->json($shipment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shipment = Shipment::find($id);

        if (!$shipment) {
            return response()->json(['message' => 'Shipment not found'], Response::HTTP_NOT_FOUND);
        }

        $shipment->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
