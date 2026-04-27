<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
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
                'in:' . implode(',', Shipment::getValidShipmentStatuses())
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
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'order_id.required' => 'Order ID is required when provided',
            'order_id.integer' => 'Order ID must be a valid integer',
            'order_id.min' => 'Order ID must be at least 1',
            'order_id.exists' => 'The selected order does not exist',
            
            'customer_id.required' => 'Customer ID is required when provided',
            'customer_id.integer' => 'Customer ID must be a valid integer',
            'customer_id.min' => 'Customer ID must be at least 1',
            'customer_id.exists' => 'The selected customer does not exist',
            
            'shipment_status.required' => 'Shipment status is required when provided',
            'shipment_status.string' => 'Shipment status must be a valid string',
            'shipment_status.in' => 'Shipment status must be one of: ' . implode(', ', Shipment::getValidShipmentStatuses()),
            
            'delivery_date.required' => 'Delivery date is required when provided',
            'delivery_date.date' => 'Delivery date must be a valid date',
            'delivery_date.date_format' => 'Delivery date must be in YYYY-MM-DD format',
            'delivery_date.after_or_equal' => 'Delivery date must be today or a future date'
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
     * @param Validator $validator
     * @return void
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'data' => null
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
