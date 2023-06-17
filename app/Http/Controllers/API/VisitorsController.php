<?php

namespace App\Http\Controllers\API;

use App\Models\Visitors;
use App\Models\Building;
use App\Models\VisitTypes;
use App\Models\VisitorLogs;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitorsRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistrationPassword;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Intervention\Image\Image;

class VisitorsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $data = Visitors::with('building')->paginate(10);
        return $this->sendResponse($data, "Fetched all Visitors in Array");
    }

    public function sendEmail(Request $request) {
        $data = Visitors::with('latestLog')->where('id', $request->id)->first();

        $building = Building::where('qr_id', $request->buildingID)->first();

        $visitType = VisitTypes::where('id', $data->latestLog->visit_purpose_id)->first()->name;

        $mailData = [
            'title' => "One-Time Password",
            'email' => $data['email'],
            'uuid' => $request->building_id,
            'name' => $data['name'],
            'ref_code' => $data['ref_code'],
            'visit_type' => $visitType,
            'contact' => $data['contact'],
            'building_name' => $building->building_name,
            'building_address' => $building->address,
            'checked_in' => $data->latestLog->created_at
        ];

        Mail::to($data['email'])->send(new UserRegistrationPassword($mailData));
        
    }

    public function sendOTP(Request $request) {
            $pass = random_int(000000, 999999);

            // $data = Visitors::where([
            //     ['id', $request->id],
            //     ['building_id', $request->buildingID]
            // ])->first();

            // Visitors::where([
            //     ['id', $request->id],
            //     ['building_id', $request->buildingID]
            // ])->update([
            //     'remember_otp' => $pass,
            //     'otp_expiry_date' => Carbon::now()->addMinutes(5)
            // ]);

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
            CURLOPT_POSTFIELDS => array('number' => $data->contact,'message' => 'Your PropTech One-Time PIN is '.$pass.'. Please do not share OTP with anyone.'),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 2|6IjBwPqcZgSeYzrlZK3UKP7T64jhumjL71w7zCIb'
            ),
            ));
            $response = curl_exec($curl);

            curl_close($curl);
    }

    public function existingVisitor(Request $request) {

        $data = Visitors::with('latestLog')->where([
            ['contact', $request->given],
            ['building_id', $request->building_ID]
        ])->orWhere([
            ['ref_code', $request->given],
            ['building_id', $request->building_ID]
        ])->orWhere([
            ['email', $request->given],
            ['building_id', $request->building_ID]
        ])->first();

        return $this->sendResponse($data, "Data found in table");
    }
    
    public function syncVisitor(Request $request) {

        $data = Visitors::with('latestLog')->where('id', $request->id)->first();        

        return $this->sendResponse($data, "Fetched data in table");
        
    }

    public function checkOTP(Request $request) {
        $data = Visitors::with('building')->where([
            'remember_otp' => $request->otp,
            ])->first();

        return $this->sendResponse($data, "Fetched data");
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
    public function store(VisitorsRequest $request)
    {
        $buildingRefID = Building::where('qr_id', $request->building_id)->first()->id;
        $validated = $request->validated();

        $existingData = Visitors::where([
            ['name', $request->name],
            ['building_id', $buildingRefID]
        ])->orWhere([
            ['email', $request->email],
            ['building_id', $buildingRefID]
        ])->orWhere([
            ['contact', $request->contact],
            ['building_id', $buildingRefID]
        ])->first();

        if($existingData == null) {
            if($request->profile_photo){
                $profile_photo_binary = $request->profile_photo;
                $profile_photo_link = time().'.' . explode('/', explode(':', substr($profile_photo_binary, 0, strpos($profile_photo_binary, ';')))[1])[1];
                
                if(!File::exists('uploads/profiles-visitor/'.$profile_photo_link)) {
                    \Image::make($profile_photo_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profile_photo_link)->destroy();
                }
                
                $validated['profile_photo'] = $profile_photo_link;
            }
    
            if($request->front_id){
                $front_id_binary = $request->front_id;
                $front_id_link = time().'.' . explode('/', explode(':', substr($front_id_binary, 0, strpos($front_id_binary, ';')))[1])[1];
                
                if(!File::exists('uploads/frontID/'.$front_id_link)) {
                    \Image::make($front_id_binary)->fit(200, 200)->save('uploads/frontID/'.$front_id_link)->destroy();
                }
                
                $validated['front_id'] = $front_id_link;
            }
    
            if($request->back_id){
                $back_id_binary = $request->back_id;
                $back_id_link = time().'.' . explode('/', explode(':', substr($back_id_binary, 0, strpos($back_id_binary, ';')))[1])[1];
                
                if(!File::exists('uploads/backID/'.$back_id_link)) {
                    \Image::make($back_id_binary)->fit(200, 200)->save('uploads/backID/'.$back_id_link)->destroy();
                }
                
                $validated['back_id'] = $back_id_link;
            }
            
            $validated['building_id'] = $buildingRefID;
            $validated['ref_code'] = Str::random(6);
            
            $data = Visitors::create($validated);

            return $this->sendResponse($data, "Data Saved.");
        }

        return $this->sendError("Some data found in table", $existingData);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Visitors $visitors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitors $visitors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitorsRequest $request, $id)
    {

        $data = Visitors::findOrFail($id);
        
        if($data->profile_photo != $request->params['data']['profile_photo']) {
            unlink('uploads/profiles-visitor/'.$data->profile_photo);
            $profile_photo_binary = $request->params['data']['profile_photo'];
            $profile_photo_link = time().'.' . explode('/', explode(':', substr($profile_photo_binary, 0, strpos($profile_photo_binary, ';')))[1])[1];
                
            \Image::make($profile_photo_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profile_photo_link)->destroy();
            
        }
        else {
            $profile_photo_link = $request->params['data']['profile_photo'];
        }

        if($data->front_id != $request->params['data']['front_id']) {
            unlink('uploads/frontID/'.$data->front_id);
            $front_id_binary = $request->params['data']['front_id'];
            $front_id_link = time().'.' . explode('/', explode(':', substr($front_id_binary, 0, strpos($front_id_binary, ';')))[1])[1];
                
            \Image::make($front_id_binary)->fit(200, 200)->save('uploads/frontID/'.$front_id_link)->destroy();
            
        }
        else {
            $front_id_link = $request->params['data']['front_id'];
        }

        if($data->back_id != $request->params['data']['back_id']) {
            unlink('uploads/backID/'.$data->back_id);
            $back_id_binary = $request->params['data']['back_id'];
            $back_id_link = time().'.' . explode('/', explode(':', substr($back_id_binary, 0, strpos($back_id_binary, ';')))[1])[1];
                
            \Image::make($back_id_binary)->fit(200, 200)->save('uploads/backID/'.$back_id_link)->destroy();
            
        }
        else {
            $back_id_link = $request->params['data']['back_id'];
        }

        $data->update([
            'building_id' => $request->params['data']['building_id'],
            'email' => $request->params['data']['email'],
            'name' => $request->params['data']['name'],
            'contact' => $request->params['data']['contact'],
            'valid_id' => $request->params['data']['valid_id'],
            'profile_photo' => $profile_photo_link,
            'front_id' => $front_id_link,
            'back_id' => $back_id_link,
            'status' => $request->params['data']['status'],
            'policy' => $request->params['data']['policy'],
        ]);
        
        return $this->sendResponse($request->validated(), "Data Updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitors $visitors)
    {
        //
    }
}
