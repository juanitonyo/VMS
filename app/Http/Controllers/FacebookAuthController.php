<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Visitors;
use App\Models\VisitTypes;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class FacebookAuthController extends Controller
{
    public function login(Request $request) {
        $building_uid = $request->get('building-id');
        session(['building_uid' => $building_uid]);
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook(Request $request) {
      
        try {
            $google_user = Socialite::driver('facebook')->user();
        
            $user = Visitors::where('email', $google_user->getEmail())->first();
            $building_uid = session('building_uid');
            if ($user) {
                return redirect()->intended('/visitor-registration/checkin/' .  $building_uid )->withCookie(cookie('id', $user->id, 1440, $httpOnly = false));
            } else {
                
               
                $refID = Building::where('qr_id',  $building_uid )->first()->id;
        
                $autoApproval = VisitTypes::where([
                    'id' => $refID,
                    'auto_approve' => true
                ])->first();
        
                if ($autoApproval != null) {
                    $validated = true;
                } else {
                    $validated = false;
                }
        
                $new_user = Visitors::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'ref_code' => Str::random(6),
                    'status' => $validated
                ]);
        
                return redirect()->intended('/visitor-registration/create/' .  $building_uid )->withCookie(cookie('id', $new_user->id, 1440, $httpOnly = false));
            }
        
        } catch (\Throwable $th) {
            dd('Something went wrong.', $th->getMessage());
        }
    }



}
