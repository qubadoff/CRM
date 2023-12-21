<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeupdateRequest extends FormRequest
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
            'compartment_id' => 'required|integer',
            'department_id' => 'required|integer',
            'position_id' => 'required|integer',
            'geometric_card_number' => 'nullable|string',
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'id_pin_number' => 'required|string|max:255',
            'birthday' => 'required|date',
            'sex' => 'required|in:male,female',
            'location' => 'required|string|max:255',
            'other_information' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'required|string|max:20',
            'education' => 'nullable|string|max:255',
            'school_name' => 'nullable|string|max:255',
            'experience' => 'nullable|string',
            'job_type' => 'required|string|max:255',
            'work_time' => 'required|string|max:255',
            'hired_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'reference' => 'nullable|string|max:255',
        ];
    }
}
