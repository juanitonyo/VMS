<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Settings\UserRequest;
use App\Models\User;
use App\Models\UserBuildings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationPassword;
use App\Models\Building;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Exports\UserExport;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = User::with('building', 'role')
            ->where('status', 1)
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->orWhere(function ($query) use ($request) {
                if ($request->search === 'active') {
                    $query->where('status', true);
                } elseif ($request->search === 'inactive') {
                    $query->where('status', false);
                }
            })
            ->orWhereHas('building', function ($query) use ($request) {
                $query->where('building_name', 'LIKE', '%' . $request->search . '%');
            })
            ->orWhereHas('role', function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate($request->limit);

        return $this->sendResponse($data, "All users in array");
    }

    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function syncHost(Request $request)
    {

        $data = User::where('id', $request->id)->with('isHost', 'building')->first();

        return $this->sendResponse($data, "Fetched data from table");
    }

    public function getAllPendingUsers()
    {
        $data = User::where('status', 0)->with('building')->get();

        return $this->sendResponse($data, "Pending Users.");
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

        $validated['role_id'] = $request['role_id']['value'];

        $hashPass = Hash::make('sysadmin');
        $validated['password'] = $hashPass;
        $data = User::create($validated);

        foreach($request->building as $building) {
            $data->building()->sync($building['value'], false);
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
    public function update(Request $request, $id)
    {   
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->params['data']['name'],
            'email' => $request->params['data']['email'],
            'role_id' => $request->params['data']['role_id'],
            'status' => $request->params['data']['status']
        ]);

        foreach ($request->params['data']['building'] as $building) {
            $user->building()->sync($building['value'], false);
        }

        return $this->sendResponse($user, "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function getSyncedUnitOwners(Request $request)
    {
        $users = DB::select("SELECT name FROM users WHERE created_at < ?", [Carbon::parse($request->get('syncTimeTriggered'))]);

        return $this->sendResponse($users, 'Data save job dispatched');
    }

    public function getUsersInBuildings(Request $request)
    {
        $buildingID = Building::where('qr_id', $request->uuid)->first()->id;

        $users = DB::select("SELECT * FROM hosts WHERE building_id LIKE ?", ['%' . $buildingID . '%']);

        $array = [];

        foreach ($users as $user) {
            $array[] = [
                'value' => $user->user_id,
                'label' => $user->first_name . ' ' . $user->last_name
            ];
        }

        return $this->sendResponse($array, "Fetched Unit Owners by Building");
    }
}
