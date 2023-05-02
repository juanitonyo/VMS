<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Visitors;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;

class GoogleAuthController extends Controller
{
    public function login() {
      
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request) {
      
        try {
            $google_user = Socialite::driver('google')->user();
            dd($google_user);
            $user = Visitors::where('google_id', $google_user->getId())->first();
            
            if($user) {
                $username = $google_user->getName();

                return redirect()->intended('/visitor-registration/create/'.$_COOKIE['buildingUUID'])->withCookie(cookie('asCookie', $google_user->getId(), 1440, $httpOnly = false));
            }
            else {

                $new_user = Visitors::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'contact' => '09174617171'
                ]);

                return redirect()->intended('/visitor-registration/create/'.$_COOKIE['buildingUUID'])->withCookie(cookie('asCookie', $google_user->getId(), 1440, $httpOnly = false));

            }

        } catch (\Throwable $th) {
            dd('Something went wrong.', $th->getMessage());
        }
    }
}
