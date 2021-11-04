<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderEmail;
use App\Mail\OrderSuccessEmail;
use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupemail($user){
        Mail::to($user->email)->send(new SignupEmail($user));
    }

    public static function sendOrderEmail($mail_data){
        Mail::to($mail_data->mail_to)->send(new NewOrderEmail($mail_data));
    }

    public static function sendAdminOrderEmail($mail_data){
        Mail::to($mail_data->mail_to)->send(new OrderSuccessEmail($mail_data));
    }
}
