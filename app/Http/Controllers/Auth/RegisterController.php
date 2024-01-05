<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Mail\ConfirmEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends BaseAuthController
{
    public function create(Request $request)
    {
        try{
            DB::beginTransaction();

            $req = new UserRegisterRequest();

            $validator = Validator::make(
                $request->all(),
                $req->rules()
            );

            if ($validator->fails()) {
                return redirect()->route('register')->with('error', 'Не вийшло зареєструвати користувача!');
            }

            $user = User::query()
                ->create([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'password'  => $request->password,
                ]);

//            dd($user);
//            $accessToken = $user->createToken($user->email)->plainTextToken;

            $currentDateTime    = Carbon::now();
            $newDateTime        = $currentDateTime->addSeconds(600);

            Cache::put('email_send_'.$user->id,'send',$newDateTime);

            Mail::to($user->fresh()->email)
                ->send(new ConfirmEmail($user->fresh()));

            DB::commit();

            return redirect()->route('wait')->with('success', 'Вам на почту '.$user->email.' відправлено лист для підтвердження!');

        }catch (\Throwable $e){

            DB::rollback();

            return response()->json(ExceptionHelper::returnResponseData($e),404);
        }
    }
}
