<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupemail($user){
        Mail::to($user->email)->send(new SignupEmail($user));
    }
}
