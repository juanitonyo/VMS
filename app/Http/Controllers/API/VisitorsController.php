<?php

namespace App\Http\Controllers\API;

use App\Models\Visitors;
use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitorsRequest;

class VisitorsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Visitors::paginate(10);
        return $this->sendResponse($data, "Fetched all Visitors in Array");
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
    public function store(VisitorsRequest $request)
    {
        $buildingRefID = Building::where('qr_id', $request->get('refId'))->first()->id;
        $validated = $request->validated();
        $validated['refId'] = $buildingRefID;

        $data = Visitors::create($validated);
        return $this->sendResponse($data, "Data Saved.");
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
        $buildingRefID = Building::where('qr_id', $request->get('refId'))->first()->id;

        $data = Visitors::findOrFail($id)->update([
            'refId' => $buildingRefID,
            'email' => $request->params['data']['email'],
            'name' => $request->params['data']['name'],
            'contact' => $request->params['data']['contact'],
            'validId' => $request->params['data']['validId'],
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
