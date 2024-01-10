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
        return view('auth.login',[
            'date'  => $this->date
        ]);
    }

    public function create(UserLoginRequest $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
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
                    ->route('login', [
                        'date'  => $this->date
                    ])
                    ->with('error','Невірний пароль, або емейл!');
            }

            if(!$user->email_verified_at){
                return redirect()
                    ->route('wait', [
                        'date'  => $this->date
                    ])
                    ->with('error', 'Підтвердіть будь ласка свій емейл - '.$user->email);
            }

            Auth::login($user);

            return redirect()
                ->route('home', [
                    'date'  => $this->date
                ])
                ->with('success','Вітаю '.$user->name);

        }catch (\Throwable $e){
            return response()->json(ExceptionHelper::returnResponseData($e),404);
        }
    }
}
