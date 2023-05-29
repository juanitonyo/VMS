<?php

namespace App\Http\Controllers\API;

use App\Models\Visitors;
use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitorsRequest;
use App\Models\VisitTypes;
use Illuminate\Support\Facades\Cookie;
use Intervention\Image\Image;
use Illuminate\Support\Str;

class VisitorsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = Visitors::with('building')->paginate(10);
        return $this->sendResponse($data, "Fetched all Visitors in Array");
    }

    public function existingVisitor(Request $request) {

        $data = Visitors::where([
            'email' => $request->given,
            'building_ID' => $request->building_ID
        ])->orWhere([
            'refCode' => $request->given,
            'building_ID' => $request->building_ID
        ])->latest()->first();

        if($data != null) {
            return $this->sendResponse($data, "Found data in table")->withCookie(cookie('id', $data->id, 1440, $httpOnly = false));
        }

        return $this->sendResponse($data, "Found data in table");
    }

    public function syncVisitor() {

        $data = Visitors::with('latestLog')->where('id', Cookie::get('id'))->first();        

        return $this->sendResponse($data, "Fetched data in table");
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VisitorsRequest $request)
    {
        $buildingRefID = Building::where('qr_id', $request->building_ID)->first(['id', 'buildingType']);

        $autoApproval = VisitTypes::where([
            'id' => $buildingRefID['id'],
            'visitApproval' => true
        ])->first();

        $profile_link = "";
        if($request->profilePhoto) {
            $profile_binary = $request->profilePhoto;
            $profile_link = time().'.' . explode('/', explode(':', substr($profile_binary, 0, strpos($profile_binary, ';')))[1])[1];
            \Image::make($profile_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profile_link)->destroy();
            
        }


        $frontID_link = "";
        if($request->front_id) {
            $frontID_binary = $request->front_id;
            $frontID_link = time().'.' . explode('/', explode(':', substr($frontID_binary, 0, strpos($frontID_binary, ';')))[1])[1];
            \Image::make($frontID_binary)->fit(200, 200)->save('uploads/frontID/'.$frontID_link)->destroy();
        }

        $backID_link = "";
        if($request->back_id) {
            $backID_binary = $request->back_id;
            $backID_link = time().'.' . explode('/', explode(':', substr($backID_binary, 0, strpos($backID_binary, ';')))[1])[1];
            \Image::make($backID_binary)->fit(200, 200)->save('uploads/backID/'.$backID_link)->destroy();
        }

        $validated = $request->validated();
        $validated['building_ID'] = $buildingRefID['id'];
        $validated['profilePhoto'] = $profile_link;
        $validated['front_id'] = $frontID_link;
        $validated['back_id'] = $backID_link;
        $validated['refCode'] = Str::random(6);
        if($autoApproval != null) {
            $validated['status'] = true;
        }

        $data = Visitors::create($validated);
        return $this->sendResponse($data, "Data Saved.")->withCookie(cookie('id', $data->id, 1440, $httpOnly = false));
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitors $visitors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitors $visitors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitorsRequest $request, $id)
    {
        $buildingRefID = Building::where('qr_id', Cookie::get('buildingUUID'))->first()->id;

        $autoApproval = VisitTypes::where([
            'id' => $buildingRefID,
            'visitApproval' => true
        ])->first();

        $profile_link = "";
        $frontID_link = "";
        $backID_link = "";
        $profile_binary = $request->params['data']['profilePhoto'];
        $frontID_binary = $request->params['data']['front_id'];
        $backID_binary = $request->params['data']['back_id'];
        $data = Visitors::findOrFail($id);

        if($profile_binary && $data->profilePhoto == null){
            $profile_link = time().'.' . explode('/', explode(':', substr($profile_binary, 0, strpos($profile_binary, ';')))[1])[1];
            \Image::make($profile_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profile_link)->destroy();
        }

        else if(('uploads/profiles-visitor/'.$data->profilePhoto) != null && $data->profilePhoto != $request->params['data']['profilePhoto']){
            unlink('uploads/profiles-visitor/'.$data->profilePhoto);
            $profile_link = time().'.' . explode('/', explode(':', substr($profile_binary, 0, strpos($profile_binary, ';')))[1])[1];
            \Image::make($profile_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profile_link)->destroy();
        }

        if($frontID_binary && $data->front_id == null){
            $frontID_link = time().'.' . explode('/', explode(':', substr($frontID_binary, 0, strpos($frontID_binary, ';')))[1])[1];
            \Image::make($frontID_binary)->fit(200, 200)->save('uploads/frontID/'.$frontID_link)->destroy();
        }

        else if(('uploads/frontID/'.$data->front_id) != null && $data->front_id != $request->params['data']['front_id']){
            unlink('uploads/frontID/'.$data->front_id);
            $frontID_link = time().'.' . explode('/', explode(':', substr($frontID_binary, 0, strpos($frontID_binary, ';')))[1])[1];
            \Image::make($frontID_binary)->fit(200, 200)->save('uploads/frontID/'.$frontID_link)->destroy();
        }

        if($backID_binary && $data->back_id == null){
            $backID_link = time().'.' . explode('/', explode(':', substr($backID_binary, 0, strpos($backID_binary, ';')))[1])[1];
            \Image::make($backID_binary)->fit(200, 200)->save('uploads/backID/'.$backID_link)->destroy();
        }

        else if(('uploads/backID/'.$data->back_id) != null && $data->back_id != $request->params['data']['back_id']){
            unlink('uploads/backID/'.$data->back_id);
            $backID_link = time().'.' . explode('/', explode(':', substr($backID_binary, 0, strpos($backID_binary, ';')))[1])[1];
            \Image::make($backID_binary)->fit(200, 200)->save('uploads/backID/'.$backID_link)->destroy();
        }

        $data = Visitors::findOrFail($id)->update([
            'building_ID' => $buildingRefID,
            'email' => $request->params['data']['email'],
            'name' => $request->params['data']['name'],
            'contact' => $request->params['data']['contact'],
            'validId' => $request->params['data']['validId'],
            'profilePhoto' => $profile_link,
            'front_id' => $frontID_link,
            'back_id' => $backID_link,
            'policy' => $request->params['data']['policy'],
        ]);
        
        return $this->sendResponse($request->validated(), "Data Updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitors $visitors)
    {
        //
    }
}
