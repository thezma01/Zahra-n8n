<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // For this task, assuming authorization is open or handled elsewhere.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'order_id' => ['required', 'integer'],
            'customer_id' => ['required', 'integer'],
            'shipment_status' => ['required', 'string', 'in:Pending,Shipped,In Transit,Delivered'],
            'delivery_date' => ['required', 'date_format:Y-m-d'],
        ];

        // For PUT/PATCH requests, fields can be optional, meaning they are only validated if present.
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            foreach ($rules as $key => $value) {
                // Prepend 'sometimes' to all rules for update operations.
                // This makes the field optional, but if present, its other rules (e.g., 'integer', 'in', 'date_format') will still apply.
                // We also remove 'required' to ensure it's not conflicting with 'sometimes'.
                $rules[$key] = array_merge(['sometimes'], array_filter($value, fn($rule) => $rule !== 'required'));
            }
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'order_id.required' => 'The order ID is required.',
            'order_id.integer' => 'The order ID must be an integer.',
            'customer_id.required' => 'The customer ID is required.',
            'customer_id.integer' => 'The customer ID must be an integer.',
            'shipment_status.required' => 'The shipment status is required.',
            'shipment_status.string' => 'The shipment status must be a string.',
            'shipment_status.in' => 'The shipment status must be one of: Pending, Shipped, In Transit, Delivered.',
            'delivery_date.required' => 'The delivery date is required.',
            'delivery_date.date_format' => 'The delivery date must be in YYYY-MM-DD format.',
        ];
    }
}
