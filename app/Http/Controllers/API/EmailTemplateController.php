<?php

namespace App\Http\Controllers\API;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\EmailTemplateRequest;
use App\Mail\CheckInEmailTemplate;
use App\Mail\EmailTemplate as MailEmailTemplate;
use App\Mail\UserRegistrationPassword;
use App\Models\Building;
use App\Models\InvitationLogs;
use App\Models\Visitors;
use App\Models\VisitTypes;
use Illuminate\Support\Facades\Mail;

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

    public function sendEmail(Request $request) {
        if($request->emailPurpose == 'checkin') {
            $data = Visitors::with('latestLog')->where('id', $request->id)->first();
            $building = Building::where('qr_id', $request->buildingID)->first();
            $visitType = VisitTypes::where('id', $data->latestLog->visit_purpose_id)->first()->name;
            $mailBody = EmailTemplate::where('purpose', $request->emailPurpose)->first()->body;

            $mailData = [
                'subject' => "Check-in Info",
                'email' => $data['email'],
                'uuid' => $request->building_id,
                'name' => $data['name'],
                'ref_code' => $data['ref_code'],
                'visit_type' => $visitType,
                'contact' => $data['contact'],
                'building_name' => $building->building_name,
                'building_address' => $building->address,
                'checked_in' => $data->latestLog->created_at,
                'mailBody' => $mailBody
            ];

            foreach ($mailData as $placeholder => $value) {
                $mailData['mailBody'] = str_replace("{!! $placeholder !!}", $value, $mailData['mailBody']);
            }

            Mail::to($data['email'])->send(new CheckInEmailTemplate($mailData));
        }
        else if($request->emailPurpose == 'invitation') {
            return $this->sendResponse($request, "Invitation has been sent!");
        }
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
