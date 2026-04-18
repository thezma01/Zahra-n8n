namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string',
            'type' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|required|string',
        ];
    }
}
