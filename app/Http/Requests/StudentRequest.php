namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $student = $this->route('student');
        $studentId = is_object($student) ? $student->id : $student;

        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('students')->ignore($studentId),
            ],
            'phone' => 'required|string',
        ];
    }
}
