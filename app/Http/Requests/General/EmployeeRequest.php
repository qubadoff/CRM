<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'compartment_id' => 'required|numeric|exists:compartments,id',
            'department_id' => 'required|numeric|exists:departments,id',
            'position_id' => 'required|numeric|exists:positions,id',
            'geometric_card_number' => 'nullable|numeric',
            'full_name' => 'required|string',
            'father_name' => 'required|string',
            'id_number' => 'required|string|unique:employees,id_number',
            'id_pin_number' => 'required|string|unique:employees,id_pin_number',
            'birthday' => 'required',
            'sex' => 'required',
            'location' => 'required',
            'other_information' => 'nullable|max:10000',
            'email' => 'nullable|email|max:150|string',
            'phone' => 'required|max:50|string|unique:employees,phone',
            'education' => 'nullable|numeric',
            'school_name' => 'nullable|max:500',
            'experience' => 'nullable|numeric',
            'job_type' => 'required',
            'work_time' => 'required|numeric',
            'hired_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'reference' => 'nullable|max:200',
            'user_photo' => 'image|mimes:jpeg,png,jpg,gif|max:4096',
            'user_documents' => 'file|mimes:pdf,doc,docx|max:2048'
        ];
    }
}
