<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

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
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                'min:2',
            ],
            'email' => [
                'sometimes',
                'required',
                'email:rfc,dns',
                'max:191',
                Rule::unique('employees', 'email')->ignore($this->employee),
            ],
            'contact' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                'min:10',
            ],
            'salary' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:999999999.99',
            ],
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
            'name.required' => 'The employee name is required.',
            'name.string' => 'The employee name must be a valid string.',
            'name.max' => 'The employee name cannot exceed 100 characters.',
            'name.min' => 'The employee name must be at least 2 characters.',
            
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email format.',
            'email.unique' => 'This email address is already registered.',
            'email.max' => 'The email address cannot exceed 191 characters.',
            
            'contact.required' => 'The contact number is required.',
            'contact.string' => 'The contact number must be a valid string.',
            'contact.max' => 'The contact number cannot exceed 20 characters.',
            'contact.min' => 'The contact number must be at least 10 characters.',
            
            'salary.required' => 'The salary is required.',
            'salary.numeric' => 'The salary must be a valid number.',
            'salary.min' => 'The salary must be a positive value.',
            'salary.max' => 'The salary value is too large.',
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
            'salary' => 'salary',
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
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
