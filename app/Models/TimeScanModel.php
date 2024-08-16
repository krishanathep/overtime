<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeScanModel extends Model
{
    use HasFactory;

    protected $table = 'tru_scan_time';

    protected $fillable = [
        'index', 
        'pin', 
        'ename',
        'time', 
        'state', 
        'verification',
        'work_code', 
        'reserved', 
        'device'
    ];
}
