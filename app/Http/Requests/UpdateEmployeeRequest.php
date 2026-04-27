<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

/**
 * Update Employee Request
 * 
 * Handles validation for updating existing employees
 */
class UpdateEmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee');

        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                'min:2',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => [
                'sometimes',
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique('employees', 'email')->ignore($employeeId)
            ],
            'contact' => [
                'sometimes',
                'required',
                'string',
                'regex:/^[\+]?[0-9\-\(\)\s]{10,20}$/',
                'min:10',
                'max:20'
            ],
            'salary' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
                'regex:/^\d+(\.\d{1,2})?$/'
            ]
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Employee name is required.',
            'name.string' => 'Employee name must be a valid string.',
            'name.max' => 'Employee name cannot exceed 100 characters.',
            'name.min' => 'Employee name must be at least 2 characters.',
            'name.regex' => 'Employee name can only contain letters and spaces.',
            
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'email.max' => 'Email address cannot exceed 255 characters.',
            
            'contact.required' => 'Contact number is required.',
            'contact.regex' => 'Please provide a valid contact number format.',
            'contact.min' => 'Contact number must be at least 10 characters.',
            'contact.max' => 'Contact number cannot exceed 20 characters.',
            
            'salary.required' => 'Salary is required.',
            'salary.numeric' => 'Salary must be a valid number.',
            'salary.min' => 'Salary cannot be negative.',
            'salary.max' => 'Salary cannot exceed 999,999.99.',
            'salary.regex' => 'Salary can have at most 2 decimal places.'
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
            'name' => 'employee name',
            'email' => 'email address',
            'contact' => 'contact number',
            'salary' => 'salary amount'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errors,
                'data' => null
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge(['name' => trim($this->name)]);
        }

        if ($this->has('email')) {
            $this->merge(['email' => strtolower(trim($this->email))]);
        }

        if ($this->has('contact')) {
            $this->merge(['contact' => trim($this->contact)]);
        }
    }
}
