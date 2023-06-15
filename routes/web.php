<?php

use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
Route::get('/login-google', [App\Http\Controllers\GoogleAuthController::class, 'login'])->middleware('guest')->name('google.login');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleAuthController::class, 'callbackGoogle'])->middleware('guest')->name('google.login.callback');

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
 
// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('google')->user();
// });

Auth::routes();
