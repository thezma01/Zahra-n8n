<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Http\Requests\StoreShipmentRequest;
use App\Http\Requests\UpdateShipmentRequest;
use App\Http\Resources\ShipmentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ShipmentController extends Controller
{
    /**
     * Display a listing of shipments.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Shipment::with(['customer', 'order']);

            // Filter by shipment status if provided
            if ($request->has('status') && !empty($request->status)) {
                $query->byStatus($request->status);
            }

            // Filter by customer ID if provided
            if ($request->has('customer_id') && !empty($request->customer_id)) {
                $query->byCustomer($request->customer_id);
            }

            // Filter by delivery date range if provided
            if ($request->has('delivery_date_from') && $request->has('delivery_date_to')) {
                $query->byDeliveryDateRange(
                    $request->delivery_date_from,
                    $request->delivery_date_to
                );
            }

            // Filter overdue shipments
            if ($request->has('overdue') && $request->boolean('overdue')) {
                $query->overdue();
            }

            // Sorting
            $sortBy = $request->get('sort_by', 'created_at');
            $sortDirection = $request->get('sort_direction', 'desc');
            
            $allowedSortFields = ['id', 'order_id', 'customer_id', 'shipment_status', 'delivery_date', 'created_at', 'updated_at'];
            if (in_array($sortBy, $allowedSortFields)) {
                $query->orderBy($sortBy, $sortDirection);
            }

            // Pagination
            $perPage = min($request->get('per_page', 15), 100); // Max 100 items per page
            $shipments = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'message' => 'Shipments retrieved successfully',
                'data' => ShipmentResource::collection($shipments->items()),
                'pagination' => [
                    'current_page' => $shipments->currentPage(),
                    'last_page' => $shipments->lastPage(),
                    'per_page' => $shipments->perPage(),
                    'total' => $shipments->total(),
                    'from' => $shipments->firstItem(),
                    'to' => $shipments->lastItem(),
                ]
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve shipments',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created shipment.
     *
     * @param \App\Http\Requests\StoreShipmentRequest $request
     * @return \Illuminate\Http\JsonResponse
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

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create shipment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified shipment.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $shipment = Shipment::with(['customer', 'order'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Shipment retrieved successfully',
                'data' => new ShipmentResource($shipment)
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Shipment not found',
                'error' => 'No shipment found with the provided ID'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve shipment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified shipment.
     *
     * @param \App\Http\Requests\UpdateShipmentRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateShipmentRequest $request, int $id): JsonResponse
    {
        try {
            $shipment = Shipment::findOrFail($id);
            $shipment->update($request->validated());
            $shipment->load(['customer', 'order']);

            return response()->json([
                'success' => true,
                'message' => 'Shipment updated successfully',
                'data' => new ShipmentResource($shipment)
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Shipment not found',
                'error' => 'No shipment found with the provided ID'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update shipment',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified shipment.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $shipment = Shipment::findOrFail($id);
            $shipment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Shipment deleted successfully',
                'data' => null
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Shipment not found',
                'error' => 'No shipment found with the provided ID'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete shipment',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
