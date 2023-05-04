<?php

namespace App\Http\Controllers\API;

use App\Models\VisitTypes;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitTypesRequest;

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
        $data = VisitTypes::create($request->all());
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
    public function update(Request $request, VisitTypes $visitTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitTypes $visitTypes)
    {
        //
    }
}
