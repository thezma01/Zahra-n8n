<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'customer_id' => $this->customer_id,
            'shipment_status' => $this->shipment_status,
            'delivery_date' => $this->delivery_date?->format('Y-m-d'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
            
            // Include related data when loaded
            'customer' => $this->whenLoaded('customer', function () {
                return [
                    'id' => $this->customer->id,
                    'customer_name' => $this->customer->customer_name,
                ];
            }),
            
            'order' => $this->whenLoaded('order', function () {
                return [
                    'id' => $this->order->id,
                    'customer_name' => $this->order->customer_name ?? null,
                    'order_summary' => $this->order->order_summary ?? null,
                    'date' => $this->order->date ?? null,
                ];
            }),
            
            // Additional computed fields
            'is_overdue' => $this->delivery_date && 
                          $this->delivery_date->isPast() && 
                          $this->shipment_status !== 'Delivered',
                          
            'days_until_delivery' => $this->delivery_date ? 
                                   now()->diffInDays($this->delivery_date, false) : null,
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'valid_shipment_statuses' => \App\Models\Shipment::getValidShipmentStatuses(),
            ],
        ];
    }
}
