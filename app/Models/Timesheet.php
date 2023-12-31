<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timesheet extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'timesheets';

    protected $fillable = [
        'compartment_id',
        'department_id',
        'employee_id',
        'date_and_time',
    ];

    protected $guarded = [];

    protected $casts = [];

    protected $dates = [
        'deleted_at'
    ];
}
