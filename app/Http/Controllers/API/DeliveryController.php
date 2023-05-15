<?php

namespace App\Http\Controllers\API;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\DeliveryRequest;
class DeliveryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Delivery::paginate(10);
        return $this->sendResponse($data, "All deliveries in array");
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
    public function store(DeliveryRequest $request)
    {
        $data = Delivery::create($request->all());
        return $this->sendResponse($data, "Saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeliveryRequest $request, Delivery $delivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
}
