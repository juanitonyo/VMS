<?php

namespace App\Http\Controllers\API;

use App\Models\VisitorLogs;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitorLogsRequests;
use App\Models\Visitors;
use App\Models\VisitTypes;
use Illuminate\Support\Facades\Cookie;
use App\Exports\VisitorLogsExport;
use Maatwebsite\Excel\Facades\Excel;

class VisitorLogsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = VisitorLogs::where([
            ['created_at', '>=', $request->filter1],
            ['created_at', '<=', $request->filter2],
        ])->with('visitor')->latest()->paginate($request->limit);
        return $this->sendResponse($data, "All Visitor Logs in Table");
    }

    public function getVisitorLogs(Request $request)
    {
        $data = VisitorLogs::where([
            ['created_at', '>=', $request->filter1],
            ['created_at', '<=', $request->filter2],
        ])->with('visitor', 'user', 'building', 'visitType')->latest()->paginate(10);
        return $this->sendResponse($data, "All Visitor Logs in Table");
    }

    public function getVisitorLog(Request $request) {
        $data = VisitorLogs::where('visitor_id', $request->id)->latest()->first(['created_at', 'updated_at']);

        return $this->sendResponse($data, "Fetched data from table.");
    }

    public function queryLog(Request $request) {
        $data = VisitorLogs::with('visitType')->where('visitor_id', $request->id)->latest()->first();
        return $this->sendResponse($data, "Fetched data from table.");
    }

    public function totalCheckOut(Request $request) {
        $data = VisitorLogs::with('visitor')->where('is_checked_out', 1)->where([
            ['created_at', '>=', $request->filter1],
            ['created_at', '<=', $request->filter2],
        ])->latest()->paginate(5);
        return $this->sendResponse($data, "Fetched check outs in table");
    }
    
    public function getIndexByUserID(Request $request) {
        $data = VisitorLogs::with('visitor')->where('user_id', $request->id)->where([
            ['created_at', '>=', $request->filter1],
            ['created_at', '<=', $request->filter2],
        ])->latest()->paginate($request->limit);
        return $this->sendResponse($data, "All Visitor Logs in Table");
    }

    public function getVisitorLogsByUserID(Request $request) {
        $data = VisitorLogs::with('visitor', 'user', 'building', 'visitType')->where('user_id', $request->id)->where([
            ['created_at', '>=', $request->filter1],
            ['created_at', '<=', $request->filter2],
        ])->latest()->paginate($request->limit);
        return $this->sendResponse($data, "All Visitor Logs in Table");
    }

    public function getTotalCheckoutForUser(Request $request) {
        $data = VisitorLogs::with('visitor')->where([
            'user_id' => $request->id,
            'is_checked_out' => 1
        ])->where([
            ['created_at', '>=', $request->filter1],
            ['created_at', '<=', $request->filter2],
        ])->latest()->paginate(5);
        return $this->sendResponse($data, "Fetched check outs in table");
    }
    public function export() 
    {
        return Excel::download(new VisitorLogsExport, 'visitorlogs.xlsx', \Maatwebsite\Excel\Excel::XLSX);
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
        $data = VisitorLogs::create($request->all());

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
        // dd($request);

        $data = VisitorLogs::findOrFail($id)->update([
            'checked_in_by' => $request->params['data']['checked_in_by'],
            'checked_out_by' => $request->params['data']['checked_out_by'],
            'approved_by' => $request->params['data']['approved_by'],
            'is_checked_out' => $request->params['data']['is_checked_out'],
            'health_form' => $request->params['data']['health_form'],
            'status' => $request->params['data']['status']
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
