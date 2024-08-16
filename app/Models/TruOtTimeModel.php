<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruOtTimeModel extends Model
{
    use HasFactory;

    protected $table = 'tru_ot_time';

    protected $fillable = [
        'ot_name', 
        'ot_list', 
        'ot_type',
        'ot_start', 
        'ot_finish', 
        'ot_total'
    ];
}
