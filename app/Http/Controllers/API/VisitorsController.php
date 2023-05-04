<?php

namespace App\Http\Controllers\API;

use App\Models\Visitors;
use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitorsRequest;
use Illuminate\Support\Facades\Cookie;

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

    public function existingVisitor($email, $refId) {
        
        $data = Visitors::where([
            'email' => $email,
            'building_ID' => $refId
        ])->first(['id', 'name']);

        return $this->sendResponse($data, "Found data in table");
    }

    public function syncVisitor() {
        $data = Visitors::where('google_id', Cookie::get('asCookie'))->first();

        return $this->sendResponse($data, 'Found data in table')->cookie(Cookie::forget('asCookie'));
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
        $buildingRefID = Building::where('qr_id', $request->get('building_ID'))->first()->id;
        $validated = $request->validated();
        $validated['building_ID'] = $buildingRefID;

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
        $buildingRefID = Building::where('qr_id', Cookie::get('buildingUUID'))->first()->id;

        $data = Visitors::findOrFail($id)->update([
            'building_ID' => $buildingRefID,
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
