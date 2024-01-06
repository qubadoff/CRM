<?php

namespace App\Http\Requests\Timesheet;

use Illuminate\Foundation\Http\FormRequest;

class TimesheetRequest extends FormRequest
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
            'compartment_id' => 'required|exists:compartments,id',
            'department_id' => 'required|exists:departments,id',
            'employee_id' => 'required|exists:employees,id',
            'date_and_time' => 'required',
        ];
    }
}
