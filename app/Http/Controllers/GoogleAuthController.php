<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Visitors;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function login() {
      
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle() {
      
        try {
            $google_user = Socialite::driver('google')->user();
            
            $user = Visitors::where('google_id', $google_user->getId())->first();
            
            if($user) {
                Auth::login($user);
            
                return redirect()->intended('/app/dashboard');
            }
            else {
            
                $new_user = Visitors::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId()
                ]);
            
                Auth::login($new_user);

                return redirect()->intended('/app/dashboard');

            }

        } catch (\Throwable $th) {
            dd('Something went wrong.', $th->getMessage());
        }
    }
}
