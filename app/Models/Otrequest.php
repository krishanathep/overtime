<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otrequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_name',
        'department',
        'ot_date',
        'ot_type',
        'ot_member_id',
        'start_date',
        'end_date',
        'total_date',
        'status',
        'create_name',
        'ot_emp',
        'review1_email',
        'work_type',
        'dept',
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'ot_emp_id', 'ot_emp');
    }
}
