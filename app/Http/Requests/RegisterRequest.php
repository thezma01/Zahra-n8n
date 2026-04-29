<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'                  => ['required', 'string', 'min:2', 'max:100'],
            'email'                 => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string'],
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
            'name.required'                  => 'Your full name is required.',
            'name.min'                       => 'Your name must be at least 2 characters.',
            'name.max'                       => 'Your name may not exceed 100 characters.',
            'email.required'                 => 'An email address is required.',
            'email.email'                    => 'Please enter a valid email address.',
            'email.unique'                   => 'This email address is already registered.',
            'password.required'              => 'A password is required.',
            'password.min'                   => 'Your password must be at least 8 characters.',
            'password.confirmed'             => 'The password confirmation does not match.',
            'password_confirmation.required' => 'Please confirm your password.',
        ];
    }
}
