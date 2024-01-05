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
    public function create(UserLoginRequest $request)
    {
        try{

            $data = $request->validated();

            // TODO При возврате на страницу с ошибкой, делать возврат емейла, что бы он оставался в поле емейл

            $user = User::query()
                ->where([
                    'email'         => $data['email'],
                ])
                ->first();

            if(is_null($user) || !Hash::check($request->password, $user->password)){
                return redirect()->route('login')->with('error','Невірний пароль, або емейл!');
            }

            Auth::login($user);

            return redirect()->route('home')->with('success','Вітаю '.$user->name);

        }catch (\Throwable $e){

            return response()->json(ExceptionHelper::returnResponseData($e),404);
            
        }
    }
}
