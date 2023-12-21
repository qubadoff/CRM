<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Award extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'awards';

    protected $fillable = [
        'user_id',
        'compartment_id',
        'department_id',
        'employee_id',
        'award_count',
        'date',
        'reason',
    ];

    protected $guarded = [];

    protected $casts = [];

    protected $dates = [
        'deleted_at'
    ];
}
