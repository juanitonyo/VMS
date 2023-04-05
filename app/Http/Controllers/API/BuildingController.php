<?php

namespace App\Http\Controllers\API;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\BuildingRequest;

class BuildingController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Building::paginate(10);
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
        $data = Building::create($request->validated());
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
        $data = Building::findOrFail($id)->update([
            'buildingName' => $request->params['data']['buildingName'],
            'description' => $request->params['data']['description'],
            'address' => $request->params['data']['address'],
            'buildingType' => $request->params['data']['buildingType'],
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
