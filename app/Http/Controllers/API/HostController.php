<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Settings\HostRequest;
use App\Models\Building;
use App\Models\Host;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class HostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Host::paginate(10);
        return $this->sendResponse($data, "Fetched all Host in Array");
    }

    public function getHostQuery() {
        $data = Host::where('building_id', Cookie::get('buildingUUID'))->get();
        $arr = [];
        foreach($data as $item) {
            $arr[] = [
                'value' => $item->id,
                'label' => $item->firstName.' '.$item->lastName
            ];
        }

        return $this->sendResponse($arr, "Fetched hosts in table");
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
    public function store(HostRequest $request)
    {
        $building_id = Building::where('qr_id', Cookie::get('buildingUUID'))->first()->id;

        $profile_link = "";
        if($request->profilePhoto) {
            $profile_binary = $request->profilePhoto;
            $profile_link = time().'.' . explode('/', explode(':', substr($profile_binary, 0, strpos($profile_binary, ';')))[1])[1];
            \Image::make($profile_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profile_link)->destroy();
        }

        $validated = $request->validated();
        $validated['building_id'] = $building_id;
        $validated['profilePhoto'] = $profile_link;

        $data = Host::create($validated);
        return $this->sendResponse($data, "Saved Data");
    }

    /**
     * Display the specified resource.
     */
    public function show(Host $host)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Host $host)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HostRequest $request, $id)
    {
        $data = Host::findOrFail($id)->update([
            'firstName' => $request->params['data']['firstName'],
            'lastName' => $request->params['data']['lastName'],
            'email' => $request->params['data']['email'],
            'password' => $request->params['data']['password'],
            'location' => $request->params['data']['location'],
            'contact' => $request->params['data']['contact'],
            'gov_id' => $request->params['data']['gov_id'],
            'role' => $request->params['data']['role'],
          ]);
          return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Host $host)
    {
        //
    }
}
