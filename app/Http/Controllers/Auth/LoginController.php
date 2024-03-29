<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ExceptionHelper;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{
    public function index(){
        return view('auth.login');
    }

    public function create(UserLoginRequest $request)
    {
        try{

            $data = $request->validated();

            $user = User::query()
                ->where([
                    'email'         => $data['email'],
                ])
                ->first();

            if(is_null($user) || !Hash::check($request->password, $user->password)){
                return redirect()
                    ->route('login')
                    ->with('error','Невірний пароль, або емейл!')
                    ->withInput();
            }

            if(!$user->email_verified_at){
                return redirect()
                    ->route('wait')
                    ->with('error', 'Підтвердіть будь ласка свій емейл - '.$user->email);
            }

            Auth::login($user);

            return redirect()
                ->route('home')
                ->with('success','Вітаю '.$user->name);

        }catch (\Throwable $e){
            return response()->json(ExceptionHelper::returnResponseData($e),404);
        }
    }
}
