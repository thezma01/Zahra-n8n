<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Http\Resources\ShipmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the shipments.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Shipment::with(['customer', 'order']);

        // Filter by shipment status
        if ($request->has('status') && !empty($request->status)) {
            $query->byStatus($request->status);
        }

        // Filter by customer ID
        if ($request->has('customer_id') && !empty($request->customer_id)) {
            $query->byCustomer($request->customer_id);
        }

        // Filter by order ID
        if ($request->has('order_id') && !empty($request->order_id)) {
            $query->byOrder($request->order_id);
        }

        // Filter by delivery date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->byDeliveryDateRange($request->start_date, $request->end_date);
        }

        // Sort by specified column
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        $allowedSortColumns = ['id', 'order_id', 'customer_id', 'shipment_status', 'delivery_date', 'created_at', 'updated_at'];
        if (in_array($sortBy, $allowedSortColumns)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $perPage = $request->get('per_page', 15);
        $perPage = min($perPage, 100); // Limit to max 100 per page

        $shipments = $query->paginate($perPage);

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
        try {
            $shipment = Shipment::create($request->validated());
            $shipment->load(['customer', 'order']);

            return response()->json([
                'success' => true,
                'message' => 'Shipment created successfully',
                'data' => new ShipmentResource($shipment)
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create shipment',
                'error' => 'An error occurred while creating the shipment'
            ], 500);
        }
    }

    /**
     * Display the specified shipment.
     *
     * @param Shipment $shipment
     * @return JsonResponse
     */
    public function show(Shipment $shipment): JsonResponse
    {
        try {
            $shipment->load(['customer', 'order']);

            return response()->json([
                'success' => true,
                'data' => new ShipmentResource($shipment)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve shipment',
                'error' => 'An error occurred while fetching the shipment'
            ], 500);
        }
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
        try {
            $shipment->update($request->validated());
            $shipment->load(['customer', 'order']);

            return response()->json([
                'success' => true,
                'message' => 'Shipment updated successfully',
                'data' => new ShipmentResource($shipment)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update shipment',
                'error' => 'An error occurred while updating the shipment'
            ], 500);
        }
    }

    /**
     * Remove the specified shipment from storage.
     *
     * @param Shipment $shipment
     * @return JsonResponse
     */
    public function destroy(Shipment $shipment): JsonResponse
    {
        try {
            $shipmentData = new ShipmentResource($shipment);
            $shipment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Shipment deleted successfully',
                'data' => $shipmentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete shipment',
                'error' => 'An error occurred while deleting the shipment'
            ], 500);
        }
    }

    /**
     * Get all valid shipment statuses.
     *
     * @return JsonResponse
     */
    public function getShipmentStatuses(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'statuses' => Shipment::getValidShipmentStatuses(),
                'total' => count(Shipment::getValidShipmentStatuses())
            ]
        ]);
    }
}
