<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deduction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'deductions';

    protected $fillable = [
        'user_id',
        'compartment_id',
        'department_id',
        'employee_id',
        'deduction_count',
        'date',
        'reason',
    ];

    protected $guarded = [];

    protected $casts = [];

    protected $dates = [
        'deleted_at'
    ];
}
