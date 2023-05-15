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
        $data = VisitorLogs::with('visitor')->paginate(1);

        return $this->sendResponse($data, "All Visitor Logs in Table");
    }

    public function queryLog() {
        $data = VisitorLogs::where('visitor_id', Cookie::get('id'))->latest()->first();

        return $this->sendResponse($data, "Fetched data from table.");

    }

    public function totalCheckOut() {
        $data = VisitorLogs::with('visitor')->where('isCheckedOut', 1)->get();
        return $this->sendResponse($data, "Fetched check outs in table");
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
            'building_id' => $request->building_id,
            'visitPurpose_id' => $request->visitPurpose_id
        ]);

        return $this->sendResponse($data, "Saved data in table")->withCookie(cookie()->forget('id'));

    }

    /**
     * Display the specified resource.
     */
    public function show(VisitorLogs $visitor_log)
    {
        return $this->sendResponse($visitor_log, "Saved data in table");
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
        $data = VisitorLogs::where('visitor_id', $id)->latest()->first()->update([
            'isCheckedOut' => 1,
        ]);

        return $this->sendResponse($data, "Checked Out Visitor")->withCookie(cookie()->forget('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitorLogs $visitorLogs)
    {
        //
    }
}
