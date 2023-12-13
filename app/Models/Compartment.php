<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compartment extends Model
{
    use HasFactory;

    protected $table = 'compartments';

    protected $fillable = [
        'uuid',
        'name',
        'category',
        'voen',
        'employee_count'
    ];

    protected $guarded = [];

    protected $casts = [];
}
