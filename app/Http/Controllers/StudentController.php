namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    public function store(StudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());

        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student,
        ], 201);
    }
}