<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     */
    public function index(): JsonResponse
    {
        $employees = Employee::all();

        return response()->json([
            'status' => true,
            'message' => 'Employees retrieved successfully',
            'data' => $employees,
        ], 200);
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email',
            'salary' => 'required|numeric|min:0',
            'contact' => 'required|string|max:255',
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Employee created successfully',
            'data' => $employee,
        ], 201);
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Employee retrieved successfully',
            'data' => $employee,
        ], 200);
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, Employee $employee): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employee->id),
            ],
            'salary' => 'sometimes|required|numeric|min:0',
            'contact' => 'sometimes|required|string|max:255',
        ]);

        $employee->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Employee updated successfully',
            'data' => $employee,
        ], 200);
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json([
            'status' => true,
            'message' => 'Employee deleted successfully',
        ], 200);
    }
}
