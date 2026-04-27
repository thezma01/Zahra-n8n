<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Http\Resources\ShipmentResource;
use App\Models\Shipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ShipmentController extends Controller
{
    /**
     * Display a listing of shipments.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Shipment::with(['order', 'customer']);

        // Filter by status
        if ($request->has('status') && $request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter by customer
        if ($request->has('customer_id') && $request->filled('customer_id')) {
            $query->byCustomer($request->customer_id);
        }

        // Filter by order
        if ($request->has('order_id') && $request->filled('order_id')) {
            $query->byOrder($request->order_id);
        }

        // Filter by delivery date range
        if ($request->has('delivery_date_from') && $request->has('delivery_date_to')) {
            $query->byDeliveryDateRange($request->delivery_date_from, $request->delivery_date_to);
        }

        // Sort by created date (newest first by default)
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $perPage = $request->get('per_page', 15);
        $shipments = $query->paginate($perPage);

        return ShipmentResource::collection($shipments);
    }

    /**
     * Store a newly created shipment in storage.
     *
     * @param StoreShipmentRequest $request
     * @return ShipmentResource
     */
    public function store(StoreShipmentRequest $request): ShipmentResource
    {
        $shipment = Shipment::create($request->validated());
        $shipment->load(['order', 'customer']);

        return new ShipmentResource($shipment);
    }

    /**
     * Display the specified shipment.
     *
     * @param Shipment $shipment
     * @return ShipmentResource
     */
    public function show(Shipment $shipment): ShipmentResource
    {
        $shipment->load(['order', 'customer']);
        return new ShipmentResource($shipment);
    }

    /**
     * Update the specified shipment in storage.
     *
     * @param UpdateShipmentRequest $request
     * @param Shipment $shipment
     * @return ShipmentResource
     */
    public function update(UpdateShipmentRequest $request, Shipment $shipment): ShipmentResource
    {
        $shipment->update($request->validated());
        $shipment->load(['order', 'customer']);

        return new ShipmentResource($shipment);
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
            'message' => 'Shipment deleted successfully',
            'data' => null
        ], Response::HTTP_OK);
    }

    /**
     * Get all valid shipment statuses.
     *
     * @return JsonResponse
     */
    public function getShipmentStatuses(): JsonResponse
    {
        return response()->json([
            'message' => 'Shipment statuses retrieved successfully',
            'data' => [
                'statuses' => Shipment::getValidShipmentStatuses()
            ]
        ], Response::HTTP_OK);
    }
}
