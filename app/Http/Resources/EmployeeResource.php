<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Employee Resource
 * 
 * Transforms Employee model data for API responses
 */
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
                'formatted' => '$' . number_format($this->salary, 2)
            ],
            'created_at' => [
                'datetime' => $this->created_at->toDateTimeString(),
                'human' => $this->created_at->diffForHumans(),
                'timestamp' => $this->created_at->timestamp
            ],
            'updated_at' => [
                'datetime' => $this->updated_at->toDateTimeString(),
                'human' => $this->updated_at->diffForHumans(),
                'timestamp' => $this->updated_at->timestamp
            ]
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
            'success' => true,
            'version' => '1.0',
            'timestamp' => now()->toISOString()
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param Request $request
     * @param \Illuminate\Http\JsonResponse $response
     * @return void
     */
    public function withResponse(Request $request, $response): void
    {
        $response->header('X-Resource-Type', 'Employee');
        $response->header('X-API-Version', '1.0');
    }
}
