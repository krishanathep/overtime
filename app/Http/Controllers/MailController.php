<?php

namespace App\Http\Controllers;

use App\Mail\MailNotify;
use App\Mail\MyDemoMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title'=>'Mail from OT-REQUEST',
            'url'=>'http://localhost:5173/overtime/'
        ];

        Mail::to('krishanathep@gmail.com')->send(new MyDemoMail($mailData));
        
        return response()->json(['Email is send successfuly.']);
    }
}
