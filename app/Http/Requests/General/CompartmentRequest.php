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

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required !',
            'name.max' => 'Name max 150 symbol !',
            'category.required' => 'Category is required !',
            'category.max' => 'Category max 150 symbol !',
            'voen.required' => 'VOEN is required !',
            'voen.max' => 'VOEN max 100 symbol !',
            'employee_count.required' => 'Employee count is required !',
            'employee_count.numeric' => 'Employee count invalid data type !',
            'employee_count.max' => 'Employee Count max 100 symbol !'
        ];
    }
}
