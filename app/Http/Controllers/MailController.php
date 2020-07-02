<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function basic_email()
    {
        $data = ['name' => $this->user->firstname];
        Mail::send(['text' => 'mail'], $data, function ($message){
            $message->to($this->user->email, $this->user->getFullName())
                ->subject('Laravel Basic Testing Mail');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });
        echo "Basic Email Sent. Check your inbox.";
    }
}
