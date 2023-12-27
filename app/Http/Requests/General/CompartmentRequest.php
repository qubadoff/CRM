<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class CompartmentRequest extends FormRequest
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
            'name' => 'required|max:150',
            'category' => 'required|max:150',
            'voen' => 'required|max:100',
            'employee_count' => 'required|numeric|max:100',
        ];
    }
}
