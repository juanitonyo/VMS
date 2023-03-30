<?php

namespace App\Http\Controllers\API;

use App\Models\emailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = emailTemplate::paginate(10);
        return $this->sendResponse($data, "All Email Template in Array.");
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
    public function store(Request $request)
    {
        $data = emailTemplate::create($request->all());
        return $this->sendResponse($data, "Saved data");
    }

    /**
     * Display the specified resource.
     */
    public function show(emailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(emailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = emailTemplate::findOrFail($id)->update([
            'purpose' => $request->params['data']['purpose'],
            'subject' => $request->params['data']['subject'],
            'body' => $request->params['data']['body'],
            'description' => $request->params['data']['description'],
            'status' => $request->params['data']['status'],
        ]);
        return $this->sendResponse($data, "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(emailTemplate $emailTemplate)
    {
        //
    }
}
