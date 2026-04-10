namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Glasses extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'length',
        'timestamp',
    ];
}