<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
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
            'order' => $this->whenLoaded('order', function () {
                return [
                    'id' => $this->order->id,
                    'order_id' => $this->order->order_id,
                    'product_id' => $this->order->product_id,
                    'customer_name' => $this->order->customer_name,
                    'order_summary' => $this->order->order_summary,
                    'date' => $this->order->date,
                ];
            }),
            
            'customer' => $this->whenLoaded('customer', function () {
                return [
                    'id' => $this->customer->id,
                    'customer_name' => $this->customer->customer_name,
                    'shipment_status' => $this->customer->shipment_status,
                    'delivery_date' => $this->customer->delivery_date?->format('Y-m-d'),
                ];
            }),
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'message' => 'Shipment data retrieved successfully',
        ];
    }
}
