<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'name' => 'required|max:100',
            'department_id' => 'required|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required !',
            'name.max' => 'Name max 100 symbol !',
            'department_id.required' => 'Department ID required !',
            'department_id.numeric' => 'Deparment id numeric type !!'
        ];
    }
}
