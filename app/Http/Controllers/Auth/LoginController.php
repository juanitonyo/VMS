<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        //$fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if(Auth::attempt($credentials)){
            return response()->json([
                'success' => true,
                'data' => auth()->user(),
                'message' => 'Login successful'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'These credentials do not match our records.'
        ], 401);
    }
}
