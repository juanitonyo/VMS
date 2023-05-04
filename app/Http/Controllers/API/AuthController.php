<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

   public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return $this->sendResponse(auth()->user(), "Current user data");
        }else{
            return $this->sendError("Error in Authenticating User.");
        }
   }

}
