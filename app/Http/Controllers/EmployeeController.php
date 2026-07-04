namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return response()->json([
            'status' => 'success',
            'data' => $employees,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees',
            'contact' => 'required',
            'salary' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $employee = Employee::create($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $employee,
        ], 201);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $employee,
        ]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:100',
            'email' => 'sometimes|required|email|unique:employees,email,' . $id,
            'contact' => 'sometimes|required',
            'salary' => 'sometimes|required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 422);
        }

        $employee->update($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $employee,
        ]);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json([
                'status' => 'error',
                'message' => 'Employee not found',
            ], 404);
        }
        $employee->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Employee deleted',
        ]);
    }
}
