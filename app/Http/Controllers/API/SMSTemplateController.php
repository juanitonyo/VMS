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

    public function sendOTP(Request $request) {
        $otp = random_int(000000, 999999);

        $data = Visitors::where([
            ['id', $request->id],
            ['building_id', $request->buildingID]
        ])->first();

        Visitors::where([
            ['id', $request->id],
            ['building_id', $request->buildingID]
        ])->update([
            'remember_otp' => $otp,
            'otp_expiry_date' => Carbon::now()->addMinutes(5)
        ]);

        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://sms.gets.ph/api/sms-push',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('number' => $data->contact,'message' => 'Your One-Time Pin is '.$otp.'. Please do not share this to anyone.'),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 2|6IjBwPqcZgSeYzrlZK3UKP7T64jhumjL71w7zCIb'
        ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
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
