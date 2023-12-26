<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRegisterRequest extends FormRequest
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
            'name' => 'required',
            'brand_name' => 'required|unique:users,brand_name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required !',
            'brand_name.required' => 'Brand Name is required !',
            'email.required' => 'Email is required !',
            'email.email' => 'Email type is invalid !',
            'password.required' => 'Password is required !'
        ];
    }
}
