<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Email\ConfirmEmailController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WaitController;
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

    Route::get('/register',                     [RegisterController::class, 'index'])->name('register');
    Route::get('/wait-confirm',                 [WaitController::class, 'index'])->name('wait');
    Route::get('/login',                        [LoginController::class, 'index'])->name('login');

    Route::get('/confirm-email/{token}',        [ConfirmEmailController::class, 'index'])->name('confirm.email');

    Route::post('/register/create',             [RegisterController::class, 'create'])->name('reg.create');
    Route::post('/login/create',                [LoginController::class, 'create'])->name('login.create');

});

Route::middleware('auth')->group( function (){

    Route::get('/',                             [HomeController::class, 'index'])->name('home');
    Route::get('/logout',                       [LogoutController::class, 'logout'])->name('logout');

    Route::post('/product/create',              [GoodsController::class, 'create'])->name('product.create');
});
