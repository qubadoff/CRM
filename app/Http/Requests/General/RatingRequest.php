<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class RatingRequest extends FormRequest
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
            'name' => 'required|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is Required !',
            'name.max' => 'Name max 50 symbol !'
        ];
    }
}
