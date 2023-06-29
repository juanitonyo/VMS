<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Visitors;
use App\Models\VisitTypes;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{

    public function login(Request $request) {
        $building_uid = $request->get('building-id');
        session(['building_uid' => $building_uid]);
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request) {
        try {
            $google_user = Socialite::driver('google')->user();
        
            $user = Visitors::where('email', $google_user->getEmail())->first();
            $building_uid = session('building_uid');
            if ($user) {
                session(['account_id' => $user->id]);
                return redirect()->intended('/visitor-registration/checkin/' .  $building_uid )->withCookie(cookie('id', $user->id, 1440, $httpOnly = false));
            } else {
                
               
                $refID = Building::where('qr_id',  $building_uid )->first()->id;
        
                $new_user = Visitors::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'ref_code' => Str::random(6),
                ]);
        
                session(['account_id' => $new_user->id]);

                return redirect()->intended('/visitor-registration/create/' .  $building_uid );
            }
        
        } catch (\Throwable $th) {
            dd('Something went wrong.', $th->getMessage());
        }
    }
}
