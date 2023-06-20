<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Settings\InvitationLogsRequest;
use App\Models\InvitationLogs;
use Illuminate\Http\Request;

class InvitationLogsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = InvitationLogs::get();

        return $this->sendResponse($data, "Fetched data in table.");
    }

    public function getInvitation(Request $request) {

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
        $data = InvitationLogs::create($request->validated());

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
