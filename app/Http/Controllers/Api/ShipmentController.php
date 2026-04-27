<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Http\Resources\ShipmentResource;
use App\Models\Shipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the shipments.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $shipments = Shipment::with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        return ShipmentResource::collection($shipments);
    }

    /**
     * Store a newly created shipment in storage.
     *
     * @param StoreShipmentRequest $request
     * @return JsonResponse
     */
    public function store(StoreShipmentRequest $request): JsonResponse
    {
        $shipment = Shipment::create($request->validated());
        
        $shipment->load('customer');

        return response()->json([
            'success' => true,
            'message' => 'Shipment created successfully',
            'data' => new ShipmentResource($shipment)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified shipment.
     *
     * @param Shipment $shipment
     * @return JsonResponse
     */
    public function show(Shipment $shipment): JsonResponse
    {
        $shipment->load('customer');

        return response()->json([
            'success' => true,
            'data' => new ShipmentResource($shipment)
        ]);
    }

    /**
     * Update the specified shipment in storage.
     *
     * @param UpdateShipmentRequest $request
     * @param Shipment $shipment
     * @return JsonResponse
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment): JsonResponse
    {
        $shipment->update($request->validated());
        
        $shipment->load('customer');

        return response()->json([
            'success' => true,
            'message' => 'Shipment updated successfully',
            'data' => new ShipmentResource($shipment)
        ]);
    }

    /**
     * Remove the specified shipment from storage.
     *
     * @param Shipment $shipment
     * @return JsonResponse
     */
    public function destroy(Shipment $shipment): JsonResponse
    {
        $shipment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Shipment deleted successfully'
        ], Response::HTTP_NO_CONTENT);
    }
}
