<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cloth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $cloths = Cloth::all();

        return response()->json([
            'success' => true,
            'message' => 'Cloths retrieved successfully',
            'data' => $cloths
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'size' => 'required|string|max:255',
            'quality' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'meter' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $cloth = Cloth::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cloth created successfully',
            'data' => $cloth
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json([
                'success' => false,
                'message' => 'Cloth not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cloth retrieved successfully',
            'data' => $cloth
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json([
                'success' => false,
                'message' => 'Cloth not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'size' => 'sometimes|required|string|max:255',
            'quality' => 'sometimes|required|string|max:255',
            'type' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'meter' => 'sometimes|required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $cloth->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cloth updated successfully',
            'data' => $cloth
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $cloth = Cloth::find($id);

        if (!$cloth) {
            return response()->json([
                'success' => false,
                'message' => 'Cloth not found',
            ], 404);
        }

        $cloth->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cloth deleted successfully',
        ], 200);
    }
}
