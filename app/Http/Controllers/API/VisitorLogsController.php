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
        $data = VisitorLogs::with('visitor')->latest()->paginate(5);

        return $this->sendResponse($data, "All Visitor Logs in Table");
    }

    public function getVisitorLog(Request $request) {
        $data = VisitorLogs::where('visitor_id', $request->id)->latest()->first(['created_at', 'updated_at']);

        return $this->sendResponse($data, "Fetched data from table.")->withCookie(cookie()->forget('id'));
    }

    public function queryLog(Request $request) {
        $data = VisitorLogs::with('visitType')->where('visitor_id', $request->id)->latest()->first();

        return $this->sendResponse($data, "Fetched data from table.");
    }

    public function totalCheckOut() {
        $data = VisitorLogs::with('visitor')->where('is_checked_out', 1)->latest()->paginate(5);
        return $this->sendResponse($data, "Fetched check outs in table");
    }

    public function getVisitorLogs()
    {
        $data = VisitorLogs::with('visitor', 'building', 'visitType')->latest()->paginate(10);

        return $this->sendResponse($data, "All Visitor Logs in Table");
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
    public function store(VisitorLogsRequests $request)
    {
        dd($request);

        $data = VisitorLogs::create($request->validated());

        return $this->sendResponse($data, "Saved data in table");

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
    public function update(VisitorLogsRequests $request, $id)
    {

        $data = VisitorLogs::where('visitor_id', $id)->latest()->first()->update([
            'is_checked_out' => 1,
            'health_form' => $request->params['data']['health_form']
        ]);

        return $this->sendResponse($data, "Checked Out Visitor");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitorLogs $visitorLogs)
    {
        //
    }
}
