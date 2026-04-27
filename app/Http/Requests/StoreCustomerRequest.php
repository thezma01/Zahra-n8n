<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Customer;

class StoreCustomerRequest extends FormRequest
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
        $validStatuses = implode(',', Customer::getValidShipmentStatuses());

        return [
            'customer_name' => [
                'required',
                'string',
                'max:100',
                'min:2',
                'regex:/^[a-zA-Z\s\-\.\']+$/'
            ],
            'shipment_status' => [
                'required',
                'string',
                'in:' . $validStatuses
            ],
            'delivery_date' => [
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
            'customer_name.required' => 'Customer name is required',
            'customer_name.string' => 'Customer name must be a string',
            'customer_name.max' => 'Customer name must not exceed 100 characters',
            'customer_name.min' => 'Customer name must be at least 2 characters',
            'customer_name.regex' => 'Customer name can only contain letters, spaces, hyphens, dots, and apostrophes',
            
            'shipment_status.required' => 'Shipment status is required',
            'shipment_status.string' => 'Shipment status must be a string',
            'shipment_status.in' => 'Shipment status must be one of: ' . implode(', ', Customer::getValidShipmentStatuses()),
            
            'delivery_date.required' => 'Delivery date is required',
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
            'customer_name' => 'customer name',
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
                'valid_shipment_statuses' => Customer::getValidShipmentStatuses()
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
        $this->merge([
            'customer_name' => trim($this->customer_name),
            'shipment_status' => trim($this->shipment_status),
        ]);
    }
}
