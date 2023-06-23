<?php

namespace App\Http\Controllers\API;

use App\Models\SMSTemplate;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\SMSTemplateRequest;
use App\Models\Visitors;
use Illuminate\Support\Carbon;

class SMSTemplateController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SMSTemplate::paginate(10);
        return $this->sendResponse($data, "All SMS in Array");
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
    public function store(SMSTemplateRequest $request)
    {
        $data = SMSTemplate::create($request->all());
        return $this->sendResponse($data, "Saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(SMSTemplate $sMSTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SMSTemplate $sMSTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SMSTemplateRequest $request, $id)
    {
        $data = SMSTemplate::findOrFail($id)->update([
            'message' => $request->params['data']['message'],
            'description' => $request->params['data']['description'],
            'status' => $request->params['data']['status'],
        ]);
        
        return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SMSTemplate $sMSTemplate)
    {
        //
    }
}
