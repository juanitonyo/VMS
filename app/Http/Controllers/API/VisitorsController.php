<?php

namespace App\Http\Controllers\API;

use App\Models\Visitors;
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
        return $this->sendResponse($data, "All Visitors in Array");
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
        $data = Visitors::create($request->all());
        return $this->sendResponse($data, "Saved");
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
        $data = Visitors::findOrFail($id)->update([
            'refId' => $request->params['data']['refId']['value'],
            'email' => $request->params['data']['email'],
            'fname' => $request->params['data']['fname'],
            'lname' => $request->params['data']['lname'],
            'contact' => $request->params['data']['contact'],
            'validId' => $request->params['data']['validId'],
        ]);
        
        return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitors $visitors)
    {
        //
    }
}
