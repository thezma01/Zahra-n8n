namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'shipment_status',
        'delivery_date',
        'timestamp',
    ];

    protected $casts = [
        'shipment_status' => 'string',
        'delivery_date' => 'date',
        'timestamp' => 'datetime',
    ];
}