<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_name',
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
        'In Transit',
        'Delivered',
        'Cancelled',
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
     * Scope a query to only include customers with specific shipment status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByShipmentStatus($query, string $status)
    {
        return $query->where('shipment_status', $status);
    }

    /**
     * Scope a query to only include customers with delivery date in range.
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
}
