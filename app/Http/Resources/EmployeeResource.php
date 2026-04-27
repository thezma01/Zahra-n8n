<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'contact' => $this->contact,
            'salary' => [
                'amount' => (float) $this->salary,
                'formatted' => number_format($this->salary, 2),
                'currency' => 'USD', // You can make this configurable
            ],
            'created_at' => [
                'datetime' => $this->created_at->toDateTimeString(),
                'iso' => $this->created_at->toISOString(),
                'human' => $this->created_at->diffForHumans(),
            ],
            'updated_at' => [
                'datetime' => $this->updated_at->toDateTimeString(),
                'iso' => $this->updated_at->toISOString(),
                'human' => $this->updated_at->diffForHumans(),
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'meta' => [
                'version' => '1.0',
                'api_url' => url('/api/employees'),
            ],
        ];
    }
}
