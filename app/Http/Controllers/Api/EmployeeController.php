<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

/**
 * Employee API Controller
 * 
 * Handles CRUD operations for employee management
 */
class EmployeeController extends Controller
{
    /**
     * Display a listing of employees
     *
     * @param Request $request
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $query = Employee::query();

            // Search functionality
            if ($request->has('search') && !empty($request->search)) {
                $query->search($request->search);
            }

            // Salary range filter
            if ($request->has('min_salary') || $request->has('max_salary')) {
                $query->salaryRange(
                    $request->min_salary ? (float) $request->min_salary : null,
                    $request->max_salary ? (float) $request->max_salary : null
                );
            }

            // Sorting
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            
            if (in_array($sortBy, ['name', 'email', 'salary', 'created_at', 'updated_at'])) {
                $query->orderBy($sortBy, in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'desc');
            }

            // Pagination
            $perPage = min((int) $request->get('per_page', 15), 100);
            $employees = $query->paginate($perPage);

            return EmployeeResource::collection($employees)->additional([
                'meta' => [
                    'total' => $employees->total(),
                    'per_page' => $employees->perPage(),
                    'current_page' => $employees->currentPage(),
                    'last_page' => $employees->lastPage(),
                ],
                'message' => 'Employees retrieved successfully'
            ]);

        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve employees',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Store a newly created employee
     *
     * @param StoreEmployeeRequest $request
     * @return JsonResponse
     */
    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        try {
            $employee = Employee::create($request->validated());

            return (new EmployeeResource($employee))->additional([
                'message' => 'Employee created successfully'
            ])->response()->setStatusCode(201);

        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create employee',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Display the specified employee
     *
     * @param int $id
     * @return EmployeeResource|JsonResponse
     */
    public function show(int $id): EmployeeResource|JsonResponse
    {
        try {
            $employee = Employee::findOrFail($id);

            return (new EmployeeResource($employee))->additional([
                'message' => 'Employee retrieved successfully'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'error' => "Employee with ID {$id} does not exist"
            ], 404);

        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve employee',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Update the specified employee
     *
     * @param UpdateEmployeeRequest $request
     * @param int $id
     * @return EmployeeResource|JsonResponse
     */
    public function update(UpdateEmployeeRequest $request, int $id): EmployeeResource|JsonResponse
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->update($request->validated());

            return (new EmployeeResource($employee->fresh()))->additional([
                'message' => 'Employee updated successfully'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'error' => "Employee with ID {$id} does not exist"
            ], 404);

        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update employee',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Remove the specified employee
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $employee = Employee::findOrFail($id);
            $employeeName = $employee->name;
            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => "Employee '{$employeeName}' deleted successfully",
                'data' => null
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'error' => "Employee with ID {$id} does not exist"
            ], 404);

        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete employee',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }
}
