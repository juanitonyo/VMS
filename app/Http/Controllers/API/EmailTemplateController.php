<?php

namespace App\Http\Controllers\API;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\EmailTemplateRequest;
use App\Mail\MailTemplate;
use App\Mail\UserRegistrationPassword;
use App\Models\Building;
use App\Models\Host;
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

        $mailData = [];

        if($request->emailPurpose == 'checkin') {
            $subject = 'VMS | Your Check-In Details';
            $data = Visitors::with('latestLog')->where('id', $request->id)->latest()->first();
            $building = Building::where('id', $data->building_id)->first(['building_name', 'qr_id', 'address']);
            $name = $data['name'];
            $visitType = VisitTypes::where('id', $data->latestLog->visit_purpose_id)->first('name');
            $time = $data->latestLog->created_at;
        }

        else if($request->emailPurpose == 'invitation') {
            $subject = 'VMS | You are invited by '.$request->inviter;
            $data = InvitationLogs::where('id', $request->id)->first();
            $building = Building::where('id', $data->building_id)->first(['building_name', 'qr_id', 'address']);
            $name = $data['first_name'].' '.$data['last_name'];
            $visitType = VisitTypes::where('id', $data->visit_purpose_id)->first(['name']);
            $time = $data->target_date;
        }
        
        $mailBody = EmailTemplate::where('purpose', $request->emailPurpose)->first()->body;

        $mailData = [
            'subject' => $subject,
            'email' => $data['email'],
            'uuid' => $building,
            'name' => $name,
            'ref_code' => $data['ref_code'],
            'visit_type' => $visitType['name'],
            'contact' => $data['contact'],
            'building_name' => $building->building_name,
            'building_address' => $building->address,
            'checked_in' => $time,
            'mailBody' => $mailBody
        ];

        foreach ($mailData as $placeholder => $value) {
            $mailData['mailBody'] = str_replace("{!! $placeholder !!}", $value, $mailData['mailBody']);
        }

        Mail::to($data['email'])->send(new MailTemplate($mailData));
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
