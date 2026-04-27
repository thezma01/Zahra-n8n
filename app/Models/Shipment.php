<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Shipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'customer_id',
        'shipment_status',
        'delivery_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'delivery_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Valid shipment status values.
     *
     * @var array<string>
     */
    public const SHIPMENT_STATUSES = [
        'Pending',
        'Shipped',
        'In Transit',
        'Delivered',
    ];

    /**
     * Get the valid shipment statuses.
     *
     * @return array<string>
     */
    public static function getValidShipmentStatuses(): array
    {
        return self::SHIPMENT_STATUSES;
    }

    /**
     * Check if shipment status is valid.
     *
     * @param string $status
     * @return bool
     */
    public static function isValidShipmentStatus(string $status): bool
    {
        return in_array($status, self::SHIPMENT_STATUSES);
    }

    /**
     * Get the customer that owns the shipment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the order associated with the shipment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Scope a query to only include shipments with specific status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('shipment_status', $status);
    }

    /**
     * Scope a query to only include shipments for a specific customer.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $customerId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCustomer($query, int $customerId)
    {
        return $query->where('customer_id', $customerId);
    }

    /**
     * Scope a query to only include shipments with delivery date in range.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDeliveryDateRange($query, string $startDate, string $endDate)
    {
        return $query->whereBetween('delivery_date', [$startDate, $endDate]);
    }

    /**
     * Scope a query to only include overdue shipments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOverdue($query)
    {
        return $query->where('delivery_date', '<', Carbon::now()->toDateString())
                    ->whereNotIn('shipment_status', ['Delivered']);
    }
}
