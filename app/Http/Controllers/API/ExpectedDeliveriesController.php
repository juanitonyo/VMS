<?php

namespace App\Http\Controllers\API;

use App\Models\ExpectedDeliveries;
use App\Http\Requests\Requests\Settings\ExpectedDeliveriesRequest;
use Illuminate\Http\Request;

class ExpectedDeliveriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ExpectedDeliveries::where('status', 1)->paginate(10);

        return $this->sendReponse($data, "Fetched data in table.");
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
        $data = ExpectedDeliveries::create($request->validated());
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
