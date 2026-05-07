namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StudentRequest $request)
    {
        $student = Student::create($request->validated());
        return redirect()->route('students.index');
    }

    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->route('students.index');
        }
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->route('students.index');
        }
        return view('students.edit', compact('student'));
    }

    public function update(StudentRequest $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->route('students.index');
        }
        $student->update($request->validated());
        return redirect()->route('students.index');
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return redirect()->route('students.index');
        }
        $student->delete();
        return redirect()->route('students.index');
    }
}
