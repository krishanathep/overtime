<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruEmployees extends Model
{
    use HasFactory;

    protected $table = 'tru_employees';

    protected $fillable = [
        'emp_id',
        'emp_name',
        'start_date',
        'work_exp',
        'bus_group',
        'position',
        'agency',
        'department',
        'dept',
    ];
}
