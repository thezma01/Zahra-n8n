<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'                  => 'Your full name is required.',
            'name.min'                       => 'Name must be at least 2 characters.',
            'name.max'                       => 'Name may not exceed 100 characters.',
            'email.required'                 => 'An email address is required.',
            'email.email'                    => 'Please enter a valid email address.',
            'email.unique'                   => 'This email address is already registered.',
            'password.required'              => 'A password is required.',
            'password.min'                   => 'Password must be at least 8 characters.',
            'password.confirmed'             => 'Password confirmation does not match.',
            'password_confirmation.required' => 'Please confirm your password.',
        ];
    }
}
