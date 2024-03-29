<?php

namespace App\Http\Controllers\API;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\EmailTemplateRequest;

class EmailTemplateController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = EmailTemplate::paginate(10);
        return $this->sendResponse($data, "All Email in Array");
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
    public function store(EmailTemplateRequest $request)
    {

        $data = EmailTemplate::create($request->all());
        return $this->sendResponse($data, "Saved");
    
    }

    /**
     * Display the specified resource.
     */
    public function show(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailTemplate $emailTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailTemplateRequest $request, $id)
    {
        $data = EmailTemplate::findOrFail($id)->update([
            'subject' => $request->params['data']['subject'],
            'purpose' => $request->params['data']['purpose'],
            'body' => $request->params['data']['body'],
            'description' => $request->params['data']['description'],
            'status' => $request->params['data']['status'],
          ]);
          return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailTemplate $emailTemplate)
    {
        //
    }
}
