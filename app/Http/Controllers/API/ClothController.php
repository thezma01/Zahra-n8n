<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cloth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ClothController extends Controller
{
    /**
     * Display a listing of all cloth records.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $cloths = Cloth::all();
            
            return response()->json([
                'success' => true,
                'message' => 'Cloths retrieved successfully',
                'data' => $cloths
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve cloths',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created cloth record in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'size' => 'required|string|max:255',
                'quality' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'meter' => 'required|integer|min:0',
            ]);

            $cloth = Cloth::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cloth created successfully',
                'data' => $cloth
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create cloth',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified cloth record.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $cloth = Cloth::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Cloth retrieved successfully',
                'data' => $cloth
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cloth not found',
                'error' => 'No cloth record found with the specified ID'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve cloth',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified cloth record in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $cloth = Cloth::findOrFail($id);

            $validatedData = $request->validate([
                'size' => 'sometimes|required|string|max:255',
                'quality' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|max:255',
                'price' => 'sometimes|required|numeric|min:0',
                'meter' => 'sometimes|required|integer|min:0',
            ]);

            $cloth->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Cloth updated successfully',
                'data' => $cloth->fresh()
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cloth not found',
                'error' => 'No cloth record found with the specified ID'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update cloth',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified cloth record from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $cloth = Cloth::findOrFail($id);
            $cloth->delete();

            return response()->json([
                'success' => true,
                'message' => 'Cloth deleted successfully',
                'data' => null
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cloth not found',
                'error' => 'No cloth record found with the specified ID'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete cloth',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
