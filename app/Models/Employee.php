<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'ot_emp_id',
        'emp_name',
        'cost_type',
        'job_type',
        'objective',
        'bus_stations',
        'code',
        'target',
        'scan',
        'out_time',
        'some_time',
        'bus_price',
        'code',
        'target',
    ];

    public function timeScanModel()
    {
        return $this->hasMany(TimeScanModel::class, 'pin', 'code');
    }
}
