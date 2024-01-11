<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class WaitController extends BaseController
{
    public function index()
    {
        return view('confirm.wait',[
            'send'  => Cache::get('email_send_again')
        ]);
    }
}
