namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CakeOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'cake_name',
        'description',
        'price',
        'flavour',
        'size',
    ];
}
