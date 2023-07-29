<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsConteoller extends Controller
{
    public function send()
    {
        $sid = env('TwILIO_SID');
        $token = env('TwILIO_TOKEN');
        $number = env('TwILIO_FROM');

        $client = new Client($sid,$token);
        $client->messages->create('+201013237805',[
            'from'=>$number,
            'body'=> 'test'
        ]);
    }
}
