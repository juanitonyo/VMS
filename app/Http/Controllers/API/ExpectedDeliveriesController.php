<?php

namespace App\Http\Controllers\API;

use App\Models\ExpectedDeliveries;
use App\Http\Requests\Settings\ExpectedDeliveriesRequest;
use Illuminate\Http\Request;

class ExpectedDeliveriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ExpectedDeliveries::with('building')->where('status', 1)->latest()->paginate(10);

        return $this->sendResponse($data, "Fetched data in table.");
    }

    public function getExpectedDeliveries() {
        $data = ExpectedDeliveries::where('status', 1)->latest()->paginate(5);

        return $this->sendResponse($data, "Fetched data in table.");
    }

    public function getExpectedDeliveriesByID(Request $request) {
        $data = ExpectedDeliveries::where('status', 1)->where('user_id', $request->id)->latest()->paginate(5);

        return $this->sendResponse($data, "Fetched data in table.");
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
    public function store(ExpectedDeliveriesRequest $request)
    {
        $data = ExpectedDeliveries::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpectedDeliveries $expectedDeliveries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpectedDeliveries $expectedDeliveries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpectedDeliveries $expectedDeliveries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpectedDeliveries $expectedDeliveries)
    {
        //
    }
}
