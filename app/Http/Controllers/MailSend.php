<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Mail\SendMail;

class MailSend extends Controller
{
    public function mailsend()
    {
        $details = [
            'title' => 'Title: Mail From Real Programmer',
            'body' => 'Body: This is for testing',
        ];

        \Mail::to('nicklin1993812@gmail.com')->send(new SendMail($details));
        return view('emails.thanks');
    }
}
