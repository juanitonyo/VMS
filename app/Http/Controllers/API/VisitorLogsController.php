<?php

namespace App\Http\Controllers\API;

use App\Models\VisitorLogs;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitorLogsRequests;
use App\Models\Visitors;
use Illuminate\Support\Facades\Cookie;

class VisitorLogsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = VisitorLogs::paginate(10);

        return $this->sendResponse($data, "All Visitor Logs in Table");
    }

    public function queryLog(Request $request) {
        $data = VisitorLogs::where('visitor_id', $request->id)->latest()->first();

        return $this->sendResponse($data, "Fetched data from table.");

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = VisitorLogs::create([
            'visitor_id' => $request->visitor_id,
            'building_id' => $request->building_id
        ]);

        return $this->sendResponse($data, "Saved data in table")->withCookie(cookie()->forget('id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(VisitorLogs $visitorLogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitorLogs $visitorLogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitorLogs $visitorLogs)
    {
        //
    }
}
