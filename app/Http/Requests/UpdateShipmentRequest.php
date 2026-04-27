<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Shipment;
use App\Models\Customer;
use App\Models\Order;

class UpdateShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $validStatuses = implode(',', Shipment::getValidShipmentStatuses());

        return [
            'order_id' => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'exists:orders,id'
            ],
            'customer_id' => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'exists:customers,id'
            ],
            'shipment_status' => [
                'sometimes',
                'required',
                'string',
                'in:' . $validStatuses
            ],
            'delivery_date' => [
                'sometimes',
                'required',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today'
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'order_id.required' => 'Order ID is required when provided',
            'order_id.integer' => 'Order ID must be an integer',
            'order_id.min' => 'Order ID must be greater than 0',
            'order_id.exists' => 'The selected order does not exist',
            
            'customer_id.required' => 'Customer ID is required when provided',
            'customer_id.integer' => 'Customer ID must be an integer',
            'customer_id.min' => 'Customer ID must be greater than 0',
            'customer_id.exists' => 'The selected customer does not exist',
            
            'shipment_status.required' => 'Shipment status is required when provided',
            'shipment_status.string' => 'Shipment status must be a string',
            'shipment_status.in' => 'Shipment status must be one of: ' . implode(', ', Shipment::getValidShipmentStatuses()),
            
            'delivery_date.required' => 'Delivery date is required when provided',
            'delivery_date.date' => 'Delivery date must be a valid date',
            'delivery_date.date_format' => 'Delivery date must be in YYYY-MM-DD format',
            'delivery_date.after_or_equal' => 'Delivery date must be today or in the future'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'order_id' => 'order ID',
            'customer_id' => 'customer ID',
            'shipment_status' => 'shipment status',
            'delivery_date' => 'delivery date'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'valid_shipment_statuses' => Shipment::getValidShipmentStatuses()
            ], 422)
        );
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('order_id')) {
            $this->merge([
                'order_id' => (int) $this->order_id
            ]);
        }

        if ($this->has('customer_id')) {
            $this->merge([
                'customer_id' => (int) $this->customer_id
            ]);
        }

        if ($this->has('shipment_status')) {
            $this->merge([
                'shipment_status' => trim($this->shipment_status)
            ]);
        }
    }
}
