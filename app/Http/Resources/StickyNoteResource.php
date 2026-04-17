namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StickyNoteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'size' => $this->size,
            'shape' => $this->shape,
            'color' => $this->color,
        ];
    }
}
