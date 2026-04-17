namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bag extends Model
{
    protected $fillable = [
        'name',
        'type',
        'price',
        'description',
    ];
}
