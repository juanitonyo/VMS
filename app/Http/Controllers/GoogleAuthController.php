<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Visitors;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function login() {
      
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request) {
      
        try {
            $google_user = Socialite::driver('google')->user();
            // dd($google_user);
            $user = Visitors::where('google_id', $google_user->getId())->first();
            
            if($user) {

                return redirect()->intended('/visitor-registration/checkin/'.Cookie::get('buildingUUID'))->withCookie(cookie('id', $user->id, 1440, $httpOnly = false));
            
            }
            else {

                $new_user = Visitors::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                ]);

                return redirect()->intended('/visitor-registration/create/'.Cookie::get('buildingUUID'))->withCookie(cookie('id', $new_user->id, 1440, $httpOnly = false));

            }

        } catch (\Throwable $th) {
            dd('Something went wrong.', $th->getMessage());
        }
    }
}
