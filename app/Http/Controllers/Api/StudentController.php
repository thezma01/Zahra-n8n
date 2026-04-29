<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class StudentController extends Controller
{
    /**
     * Display a listing of all students.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $students = Student::orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => 'Students retrieved successfully.',
                'data' => $students,
                'count' => $students->count(),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve students.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        try {
            $student = Student::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Student created successfully.',
                'data' => $student,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create student.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $student = Student::findOrFail($id);

            return response()->json([
                'success' => true,
                'message' => 'Student retrieved successfully.',
                'data' => $student,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
                'error' => "No student found with ID: {$id}",
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve student.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified student in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStudentRequest $request, int $id): JsonResponse
    {
        try {
            $student = Student::findOrFail($id);
            $student->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully.',
                'data' => $student->fresh(),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
                'error' => "No student found with ID: {$id}",
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update student.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $student = Student::findOrFail($id);
            $studentData = $student->toArray();
            $student->delete();

            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully.',
                'data' => $studentData,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.',
                'error' => "No student found with ID: {$id}",
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete student.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
