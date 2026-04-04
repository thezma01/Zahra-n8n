<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Http\Resources\ShipmentResource;
use App\Models\Shipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShipmentController extends Controller
{
    /**
     * Display a listing of all shipments.
     */
    public function index(): AnonymousResourceCollection
    {
        $shipments = Shipment::latest()->paginate(15);

        return ShipmentResource::collection($shipments);
    }

    /**
     * Store a newly created shipment.
     */
    public function store(StoreShipmentRequest $request): JsonResponse
    {
        $shipment = Shipment::create($request->validated());

        return response()->json([
            'message' => 'Shipment created successfully.',
            'data'    => new ShipmentResource($shipment),
        ], 201);
    }

    /**
     * Display the specified shipment.
     */
    public function show(Shipment $shipment): JsonResponse
    {
        return response()->json([
            'data' => new ShipmentResource($shipment),
        ], 200);
    }

    /**
     * Update the specified shipment.
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment): JsonResponse
    {
        $shipment->update($request->validated());

        return response()->json([
            'message' => 'Shipment updated successfully.',
            'data'    => new ShipmentResource($shipment->fresh()),
        ], 200);
    }

    /**
     * Remove the specified shipment.
     */
    public function destroy(Shipment $shipment): JsonResponse
    {
        $shipment->delete();

        return response()->json([
            'message' => 'Shipment deleted successfully.',
        ], 200);
    }
}