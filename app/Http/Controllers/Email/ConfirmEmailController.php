<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\BaseController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ConfirmEmailController extends BaseController
{
    public function index($token){

        $user = User::query()
            ->whereRaw('MD5(CONCAT(id, email)) = ?', [$token])
            ->first();

        if(is_null($user)){
            abort('400');
        }

        if (!is_null($user->email_verified_at)){
            Auth::login($user);
            return redirect()->route('home')->with('success','Емейл успішно пудтверджено!');;
        }

        Cache::delete('email_send_'.$user->id);

        User::query()
            ->where([
                'id' => $user->id
            ])
            ->update([
                'email_verified_at' => Carbon::now()
            ]);

        Auth::login($user);

        return redirect()->route('home')->with('success','Емейл успішно пудтверджено!');
    }
}
