namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
}
