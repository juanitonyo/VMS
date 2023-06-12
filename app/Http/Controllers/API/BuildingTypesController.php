<?php

namespace App\Http\Controllers\API;

use App\Models\BuildingTypes;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\BuildingTypeRequest;

class BuildingTypesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BuildingTypes::paginate(10);
        return $this->sendResponse($data, "All building types in array");
    }

    // get active building types
    public function getBuildingTypeArray(){
        $data = BuildingTypes::where('status', 1)->get();
        $arr = [];
        foreach($data as $item){
            $arr[] = [
                'value' => $item->id,
                'label' => $item->name
            ]; 
        }
        return $this->sendResponse($arr, "All buildings in array");
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
    public function store(BuildingTypeRequest $request)
    {

        $data = BuildingTypes::create($request->validated());
        return $this->sendResponse($data, "Saved Data");
      
    }

    /**
     * Display the specified resource.
     */
    public function show(BuildingTypes $buildingTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BuildingTypes $buildingTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BuildingTypeRequest $request, $id)
    {

        $data = BuildingTypes::findOrFail($id)->update([
            'name' => $request->params['data']['name'],
            'description' => $request->params['data']['description'],
            'delivery_form' => $request->params['data']['delivery_form'],
            'status' => $request->params['data']['status'],
        ]);
        return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BuildingTypes $buildingTypes)
    {
        //
    }
}
