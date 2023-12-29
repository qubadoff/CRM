<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $table = 'vacations';

    protected $fillable = [
        'compartment_id',
        'department_id',
        'employee_id',
        'vacation_date',
        'status',
        'type',
        'reason',
    ];

    protected $guarded = [];

    protected $casts = [];

    protected $dates = ['deleted_at'];
}
