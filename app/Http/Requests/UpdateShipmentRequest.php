<?php

namespace App\Http\Requests;

use App\Models\Shipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateShipmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'order_id' => [
                'sometimes',
                'integer',
                'min:1'
            ],
            'customer_id' => [
                'sometimes',
                'integer',
                'exists:customers,id'
            ],
            'shipment_status' => [
                'sometimes',
                'string',
                'in:' . implode(',', Shipment::getValidShipmentStatuses())
            ],
            'delivery_date' => [
                'sometimes',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'order_id.integer' => 'Order ID must be an integer',
            'order_id.min' => 'Order ID must be at least 1',
            'customer_id.integer' => 'Customer ID must be an integer',
            'customer_id.exists' => 'The selected customer does not exist',
            'shipment_status.in' => 'Shipment status must be one of: ' . implode(', ', Shipment::getValidShipmentStatuses()),
            'delivery_date.date' => 'Delivery date must be a valid date',
            'delivery_date.date_format' => 'Delivery date must be in YYYY-MM-DD format',
            'delivery_date.after_or_equal' => 'Delivery date must be today or a future date'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
