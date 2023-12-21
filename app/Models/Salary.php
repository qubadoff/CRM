<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'salaries';

    protected $fillable = [
        'user_id',
        'compartment_id',
        'department_id',
        'employee_id',
        'salary_count',
    ];

    protected $guarded = [];

    protected $casts = [];

    protected $dates = [
        'deleted_at'
    ];
}
