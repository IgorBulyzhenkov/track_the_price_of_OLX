<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SendAgainEmailController extends BaseController
{
    public function send(Request $request)
    {
        $value = Cache::get('email_send_again');

        if(Cache::has('email_send_again')){
            return redirect()->route('wait')->with('success', 'Лист відправленно на цей email '.$value.'!');
        }

        $email = Session::get('send_email');

        $currentDateTime    = Carbon::now();
        $newDateTime        = $currentDateTime->addSeconds(600);

        $user = User::query()
            ->where('email', $email)
            ->first();

        Cache::put('email_send_again', $email, $newDateTime);
        Cache::put('email_send_'.$user->id,'send', $newDateTime);
        Session::put('send_email', $user->email);

        Mail::to($user->email)
            ->send(new ConfirmEmail($user));

        return redirect()->route('wait')->with('success', 'Лист відправленно на цей email '.$email.'!');
    }
}
