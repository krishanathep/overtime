<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruAppMasster extends Model
{
    use HasFactory;

    protected $table = 'tru_approver_master';

    protected $fillable = [
        'agency', 
        'division', 
        'dept',
        'app_id_1', 
        'app_name_1', 
        'app_email_1',
        'app_id_2', 
        'app_name_2', 
        'app_email_2',
        'app_id_3', 
        'app_name_3',
        'app_email_3',
        'app_id_4',
        'app_name_4',
        'app_email_4'
    ];
}
