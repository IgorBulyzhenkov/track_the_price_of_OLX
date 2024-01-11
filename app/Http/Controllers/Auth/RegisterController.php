<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ExceptionHelper;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Mail\ConfirmEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends BaseAuthController
{
    public function index(){
        return view('auth.register');
    }

    public function create(UserRegisterRequest $request)
    {
        try{
            DB::beginTransaction();

            $data = $request->validated();

            $user = User::query()
                ->create([
                    'name'      => $data['name'],
                    'email'     => $data['email'],
                    'password'  => $data['password'],
                ]);

            $currentDateTime    = Carbon::now();
            $newDateTime        = $currentDateTime->addSeconds(600);

            Cache::put('email_send_'.$user->id,'send', $newDateTime);

            Cache::put('email_send_again', $user->fresh()->email, $newDateTime);

            Session::put('send_email', $user->fresh()->email);

            Mail::to($user->fresh()->email)
                ->send(new ConfirmEmail($user->fresh()));

            DB::commit();

            return redirect()
                ->route('wait')
                ->with('success', 'Вам на почту '.$user->email.' відправлено лист для підтвердження!');

        }catch (\Throwable $e){

            DB::rollback();

            return response()->json(ExceptionHelper::returnResponseData($e),404);
        }
    }
}
