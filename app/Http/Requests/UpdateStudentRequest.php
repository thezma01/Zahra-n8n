<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        // The route parameter is named 'id' (e.g. PUT /api/students/{id})
        // so we use $this->route('id') to retrieve the student's primary key
        // for the unique-ignore rule on roll_no during updates.
        $studentId = $this->route('id');

        return [
            'name'    => ['required', 'string', 'max:255'],
            'class'   => ['required', 'string', 'max:100'],
            'roll_no' => [
                'required',
                'integer',
                Rule::unique('students', 'roll_no')->ignore($studentId),
            ],
            'contact' => ['required', 'string', 'regex:/^[0-9+\-\s()]+$/', 'min:10', 'max:20'],
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
            'name.required'    => 'Student name is required.',
            'name.string'      => 'Student name must be a valid string.',
            'name.max'         => 'Student name must not exceed 255 characters.',
            'class.required'   => 'Class is required.',
            'class.string'     => 'Class must be a valid string.',
            'class.max'        => 'Class must not exceed 100 characters.',
            'roll_no.required' => 'Roll number is required.',
            'roll_no.integer'  => 'Roll number must be a valid number.',
            'roll_no.unique'   => 'This roll number is already assigned to another student.',
            'contact.required' => 'Contact number is required.',
            'contact.string'   => 'Contact must be a valid string.',
            'contact.regex'    => 'Contact must be a valid phone number format.',
            'contact.min'      => 'Contact number must be at least 10 characters.',
            'contact.max'      => 'Contact number must not exceed 20 characters.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors occurred.',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
}
