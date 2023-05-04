<?php

namespace App\Http\Controllers\API;

use App\Models\VisitTypes;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitTypesRequest;
use App\Models\BuildingTypes;

class VisitTypesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = VisitTypes::paginate(10);
        return $this->sendResponse($data, "All Visit Types in Array");
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
    public function store(VisitTypesRequest $request)
    {
        $buildingType_id = BuildingTypes::where('name', $request->get('buildingType_id'))->first()->id;
        $validated = $request->validated();
        $validated['buildingType_id'] = $buildingType_id;

        $data = VisitTypes::create($validated);
        return $this->sendResponse($data, "Saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(VisitTypes $visitTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitTypes $visitTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitTypesRequest $request, $id)
    {
        $buildingType_id = BuildingTypes::where('name', $request->params['data']['buildingType_id'])->first()->id;

        $data = VisitTypes::findOrFail($id)->update([
            'buildingType_id' => $buildingType_id,
            'name' => $request->params['data']['name'],
            'visitApproval' => $request->params['data']['visitApproval'],
            'status' => $request->params['data']['status']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitTypes $visitTypes)
    {
        //
    }
}
