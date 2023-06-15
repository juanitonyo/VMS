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
    public function login() {
      
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request) {
      
        try {
            $google_user = Socialite::driver('google')->user();
            // dd($google_user);
            $user = Visitors::where('email', $google_user->getEmail())->first();
            
            if($user) {

                return redirect()->intended('/visitor-registration/checkin/'.Cookie::get('buildingUUID'))->withCookie(cookie('id', $user->id, 1440, $httpOnly = false));
            
            }
            else {
                $refID = Building::where('qr_id', Cookie::get('buildingUUID'))->first()->id;

                $autoApproval = VisitTypes::where([
                    'id' => $refID,
                    'autoApprove' => true
                ])->first();

                if($autoApproval != null) {
                    $validated = true;
                }
                else {
                    $validated = false;
                }

                $new_user = Visitors::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'refCode' => Str::random(6),
                    'status' => $validated
                ]);

                return redirect()->intended('/visitor-registration/create/'.Cookie::get('buildingUUID'))->withCookie(cookie('id', $new_user->id, 1440, $httpOnly = false));

            }

        } catch (\Throwable $th) {
            dd('Something went wrong.', $th->getMessage());
        }
    }
}
