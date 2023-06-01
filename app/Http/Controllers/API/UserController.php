<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Settings\UserRequest;
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
        $data = User::whereHas('userBuilding')
            ->with(['userBuilding.building', 'role'])
            ->latest()
            ->paginate(100);

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
    public function store(UserRequest $request)
    {

        $validated = $request->validated();

        $hashPass = Hash::make('sysadmin');
        $validated['password'] = $hashPass;
        $validated['role_id'] = $request->role['id'];
        $data = User::create($validated);
       
        if ($request->building) {

                UserBuildings::create([
                    'user_id' => $data->id,
                    'building_id' => $request->building['value']
                ]);
            }

        return $this->sendResponse($data, "Saved data to table.");
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
    public function update(Request $request, User $user)
    {   
        $user->update($request->params['data']);

        if ($request->params['data']['role']) {
            $user->update([
                'role_id' => $request->params['data']['role']['id']
            ]);
        }

        if ($request->params['data']['building']) {
            UserBuildings::where('user_id', $user->id)->update([
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
