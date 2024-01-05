<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Email\ConfirmEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group( function(){

    Route::view('/register',                'auth.register')->name('register');
    Route::view('/wait-confirm',            'confirm.wait')->name('wait');
    Route::view('/login',                   'auth.login')->name('login');

    Route::get('/confirm-email/{token}',        [ConfirmEmailController::class, 'index'])->name('confirm.email');

    Route::post('/register/create',             [RegisterController::class, 'create'])->name('reg.create');
    Route::post('/login/create',                [LoginController::class, 'create'])->name('login.create');

});

Route::middleware('auth')->group( function (){

    Route::view('/',                        'home.index')->name('home');

    Route::get('/logout',                       [LogoutController::class, 'logout'])->name('logout');
});
