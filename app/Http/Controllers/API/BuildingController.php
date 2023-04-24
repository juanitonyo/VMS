<?php

namespace App\Http\Controllers\API;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\BuildingRequest;
use Intervention\Image\Image;
use Illuminate\Support\Str;

class BuildingController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Building::with('buildingType')->paginate(10);
        return $this->sendResponse($data, "All buildings in array");
    }

    public function getBuilding($id){
        $data = Building::where('qr_id', $id)->first(['id', 'buildingName', 'address', 'logo']);
       
        return $this->sendResponse($data, "All buildings in array");
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
    public function store(BuildingRequest $request)
    {
        $logo_link = "";
        if($request->logo){
            $logo_binary = $request->logo;
            $logo_link = time().'.' . explode('/', explode(':', substr($logo_binary, 0, strpos($logo_binary, ';')))[1])[1];
            \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/'.$logo_link)->destroy();
        }

        $validated = $request->validated();
        $validated['logo']   = $logo_link;

        $data = Building::create($validated);
        return $this->sendResponse($data, "Saved Data");
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BuildingRequest $request, $id)
    {
        $logo_link = "";
        $logo_binary = $request->params['data']['logo'];
        $data = Building::findOrFail($id);
        if($logo_binary){
            unlink('public/uploads/images/'.$data->logo);
            $logo_link = time().'.' . explode('/', explode(':', substr($logo_binary, 0, strpos($logo_binary, ';')))[1])[1];
            \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/'.$logo_link)->destroy();
        }
        
        

        $data->update([
            'buildingName' => $request->params['data']['buildingName'],
            'description' => $request->params['data']['description'],
            'address' => $request->params['data']['address'],
            'logo' => $logo_link,
            'buildingType' => $request->params['data']['buildingType']['value'],
            'status' => $request->params['data']['status'],
          ]);
         
        
           return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        //
    }
}
