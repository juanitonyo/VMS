<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\UserBuildings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationPassword;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::whereHas('userBuilding')->with('userBuilding.building')->latest()->paginate(100);

        return $this->sendResponse($data, "All users in array");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $emailPurpose = EmailTemplate::where('purpose', 'Register')->first();
        
        if($emailPurpose != null) {
            
            $hashPass = Hash::make('sysadmin');
            $request['password'] = $hashPass;
            $data = User::create($request->all());
    
            if ($request->building) {


                UserBuildings::create([
                    'user_id' => $data->id,
                    'building_id' => $request->building['value']
                ]);
            }
    
    
            $mailData = [
                'title' => 'Registration Password',
                'body' => $emailPurpose['body'],
            ];
    
            Mail::to($data['email'])->send(new UserRegistrationPassword($mailData));

            return $this->sendResponse($data, "Saved Data");

        }

        return null;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = User::findOrFail($id)->update([
            'name' => $request->params['data']['name'],
            'email' => $request->params['data']['email'],
        ]);

        if ($request->params['data']['building']) {
            UserBuildings::where('user_id', $id)->update([
                'building_id' => $request->params['data']['building']['value']
            ]);
        }

        return $this->sendResponse($request->params['data']['building'], "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
