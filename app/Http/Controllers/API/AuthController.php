<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\RoleHasPermissions;

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

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $role_has_permissions = RoleHasPermissions::where('role_id', $user->role->id)->with('permission')->get();

            $permissions = [];

            foreach ($role_has_permissions as $key => $value) {
                $permissions[$value->permission->module][] = $value->permission->name;
            }
            
            return $this->sendResponse([
                'user' => auth()->user(),
                'role' => [
                    'name' => $user->role->name,
                    'permissions' => $permissions,
                ]
            ], "Current user data");
        } else {
            return $this->sendError("Error in Authenticating User.");
        }
    }
}