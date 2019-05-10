<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class MailController extends Controller
{
    /**
     * Send reset password email.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function mail($email, $token)
    {
        Mail::to($email)->send(new SendMailable($token));
       
       return 'Email was sent';
    }
}
