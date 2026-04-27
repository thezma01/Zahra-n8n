<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'shipment_status' => $this->shipment_status,
            'delivery_date' => $this->delivery_date->format('Y-m-d'),
            'delivery_date_formatted' => $this->delivery_date->format('M d, Y'),
            'days_until_delivery' => $this->getDaysUntilDelivery(),
            'is_overdue' => $this->isOverdue(),
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
            'timestamps' => [
                'created_at_human' => $this->created_at->diffForHumans(),
                'updated_at_human' => $this->updated_at->diffForHumans(),
                'created_at_formatted' => $this->created_at->format('M d, Y H:i'),
                'updated_at_formatted' => $this->updated_at->format('M d, Y H:i'),
            ],
            'status_info' => [
                'status' => $this->shipment_status,
                'color' => $this->getStatusColor(),
                'is_active' => $this->isActiveStatus(),
                'is_completed' => $this->shipment_status === 'Delivered',
                'is_cancelled' => $this->shipment_status === 'Cancelled',
            ]
        ];
    }

    /**
     * Get the number of days until delivery.
     *
     * @return int
     */
    protected function getDaysUntilDelivery(): int
    {
        return Carbon::now()->diffInDays($this->delivery_date, false);
    }

    /**
     * Check if the delivery is overdue.
     *
     * @return bool
     */
    protected function isOverdue(): bool
    {
        return $this->delivery_date->isPast() && 
               !in_array($this->shipment_status, ['Delivered', 'Cancelled']);
    }

    /**
     * Get the color associated with the shipment status.
     *
     * @return string
     */
    protected function getStatusColor(): string
    {
        return match ($this->shipment_status) {
            'Pending' => '#FFA500',
            'In Transit' => '#007BFF',
            'Delivered' => '#28A745',
            'Cancelled' => '#DC3545',
            default => '#6C757D',
        };
    }

    /**
     * Check if the status is active (not delivered or cancelled).
     *
     * @return bool
     */
    protected function isActiveStatus(): bool
    {
        return !in_array($this->shipment_status, ['Delivered', 'Cancelled']);
    }

    /**
     * Get additional data to be included at the top level.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'version' => '2.0',
                'timestamp' => now()->toISOString(),
            ]
        ];
    }
}
