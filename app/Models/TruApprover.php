<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruApprover extends Model
{
    use HasFactory;

    protected $table = 'tru_approver';

    protected $fillable = [
        'title', 
        'division', 
        'agency',
        'id_approve_1', 
        'name_approve_1', 
        'email_approve_1',
        'id_approve_2', 
        'name_approve_2', 
        'email_approve_2',
        'id_approve_3', 
        'name_approve_3',
        'email_approve_3',
        'id_approve_4',
        'name_approve_4',
        'email_approve_4'
    ];
}
