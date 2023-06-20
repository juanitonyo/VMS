<?php

namespace App\Http\Controllers\API;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\BuildingRequest;
use Illuminate\Support\Facades\File;

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

    // get specific building
    public function getBuilding(Request $request){

        $data = Building::with('buildingType')->where('qr_id', $request->buildingUUID)->first();
       
        return $this->sendResponse($data, "All buildings in array");

    }

    // get active buildings
    public function getBuildingsArray(){
        $data = Building::where('status', 1)->get();

        $array = [];

        foreach($data as $item){
            $array[] = [
                'value' => $item->id,
                'label' => $item->building_name
            ]; 
        }
        return $this->sendResponse($array, "All buildings in array");
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
        $validated = $request->validated();

        if($request->logo){
            $logo_binary = $request->logo;
            $logo_link = time().'.' . explode('/', explode(':', substr($logo_binary, 0, strpos($logo_binary, ';')))[1])[1];
            
            if(!File::exists('uploads/images/'.$logo_link)) {
                \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/'.$logo_link)->destroy();
            }
            
            $validated['logo'] = $logo_link;
        }

        $data = Building::create($validated);
        return $this->sendResponse($logo_link, "Saved Data");
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
        $data = Building::findOrFail($id);

        if($request->params['data']['logo']){
            $logo_binary = $request->params['data']['logo'];

            if($data->logo != $request->params['data']['logo']) {
                $logo_link = time().'.' . explode('/', explode(':', substr($logo_binary, 0, strpos($logo_binary, ';')))[1])[1];
            }
            else {
                $logo_link = $request->params['data']['logo'];
            }

            if(!File::exists('uploads/images/'.$logo_link)) { //does not exists
                \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/'.$logo_link)->destroy();
                $data->update([
                    'logo' => $logo_link,
                ]);
            }

            else if($data->logo != $logo_link) { // is existing
                unlink('uploads/images/'.$data->logo);
                \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/'.$logo_link)->destroy();
                $data->update([
                    'logo' => $logo_link,
                ]);
            }
        }

        $data->update([
            'buildingName' => $request->params['data']['buildingName'],
            'description' => $request->params['data']['description'],
            'address' => $request->params['data']['address'],
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
