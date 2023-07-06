<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Settings\InvitationLogsRequest;
use App\Models\Building;
use App\Models\InvitationLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class InvitationLogsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = InvitationLogs::with(['building', 'visitType', 'latestLog'])->paginate(10);

        return $this->sendResponse($data, "Fetched data in table.");
    }

    public function getInvitation(Request $request) {

        $data = InvitationLogs::with('latestLog')->where([
            ['email', $request->given],
            ['building_id', $request->building_id]
        ])->orWhere([
            ['ref_code', $request->given],
            ['building_id', $request->building_id]
        ])->latest()->first();

        if($data == null) {
            return $this->sendError("Invitation not found.", $data);
        }
        
        else if($data['target_date'] > Carbon::now()) {
            return $this->sendError("Your check-in is too early.");
        }

        return $this->sendResponse($data, "Data exist");
    }

    public function syncInvitee(Request $request) {
        $data = InvitationLogs::with(['latestLog', 'visitType', 'user'])->where('id', $request->id)->first();

        return $this->sendResponse($data, "Fetched data in table");
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
    public function store(InvitationLogsRequest $request)
    {
        $validated = $request->validated();
        $validated['ref_code'] = Str::random(6);

        $data = InvitationLogs::create($validated);

        return $this->sendResponse($data, "Data stored in table");
    }

    /**
     * Display the specified resource.
     */
    public function show(InvitationLogs $invitationLogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvitationLogs $invitationLogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvitationLogs $invitationLogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvitationLogs $invitationLogs)
    {
        //
    }
}
