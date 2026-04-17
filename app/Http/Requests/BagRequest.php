namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
}
