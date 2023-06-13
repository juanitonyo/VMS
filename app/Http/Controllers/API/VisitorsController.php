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

    public function existingVisitor(Request $request) {

        $data = Visitors::with("latestLog")->where([
            ['contact', $request->given],
            ['building_ID', $request->building_ID]
        ])->orWhere([
            ['refCode', $request->given],
            ['building_ID', $request->building_ID]
        ])->orWhere([
            ['email', $request->given],
            ['building_ID', $request->building_ID]
        ])->first();

        $building = Building::where('id', $request->building_ID)->first();

        if($data->status && $data->latestLog->isCheckedOut) {
            if($request->given == $data['email']) {
                $pass = random_int(000000, 999999);
                
                Visitors::findOrFail($data['id'])->update([
                    'remember-otp' => $pass,
                    'otp_expiry_date' => Carbon::now()->addMinutes(5)
                ]);
                
                $mailData = [
                    'title' => "One-Time Password",
                    'email' => $data['email'],
                    'password' => $pass,
                    'uuid' => $request->building_ID,
                    'name' => $data['name'],
                    'refCode' => $data['refCode'],
                    'contact' => $data['contact'],
                    'buildingName' => $building->buildingName,
                    'buildingAddress' => $building->address,
                    'checkedIn' => $data->latestLog->created_at
                ];

                Mail::to($data['email'])->send(new UserRegistrationPassword($mailData));

            }

            else if($request->given == $data['contact']) {
                $pass = random_int(000000, 999999);

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
                CURLOPT_POSTFIELDS => array('number' => $request->given,'message' => 'Your PropTech One-Time PIN is '.$pass.'. Please do not share OTP with anyone.'),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer 2|6IjBwPqcZgSeYzrlZK3UKP7T64jhumjL71w7zCIb'
                ),
                ));
                $response = curl_exec($curl);

                curl_close($curl);
                return response()->json([
                    'success' => true,
                    'message' => $response,
                    'code' => $pass
                ]);
            }
        }

        return $this->sendResponse($data, "Data found in table");
    }
    
    public function syncVisitor(Request $request) {

        $data = Visitors::with('latestLog')->where('id', $request->id)->first();        

        return $this->sendResponse($data, "Fetched data in table");
        
    }

    public function checkOTP(Request $request) {
        $data = Visitors::with('building')->where([
            'remember-otp' => $request->otp,
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
        $buildingRefID = Building::where('qr_id', $request->building_ID)->first()->id;
        $validated = $request->validated();

        $existingData = Visitors::where([
            ['name', $request->name],
            ['building_ID', $buildingRefID]
        ])->orWhere([
            ['email', $request->email],
            ['building_ID', $buildingRefID]
        ])->orWhere([
            ['contact', $request->contact],
            ['building_ID', $buildingRefID]
        ])->first();

        if($existingData == null) {
            if($request->profilePhoto){
                $profilePhoto_binary = $request->profilePhoto;
                $profilePhoto_link = time().'.' . explode('/', explode(':', substr($profilePhoto_binary, 0, strpos($profilePhoto_binary, ';')))[1])[1];
                
                if(!File::exists('uploads/profiles-visitor/'.$profilePhoto_link)) {
                    \Image::make($profilePhoto_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profilePhoto_link)->destroy();
                }
                
                $validated['profilePhoto'] = $profilePhoto_link;
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
            
            $validated['building_ID'] = $buildingRefID;
            $validated['refCode'] = Str::random(6);
            
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
        
        if($data->profilePhoto != $request->params['data']['profilePhoto']) {
            unlink('uploads/profiles-visitor/'.$data->profilePhoto);
            $profilePhoto_binary = $request->params['data']['profilePhoto'];
            $profilePhoto_link = time().'.' . explode('/', explode(':', substr($profilePhoto_binary, 0, strpos($profilePhoto_binary, ';')))[1])[1];
                
            \Image::make($profilePhoto_binary)->fit(200, 200)->save('uploads/profiles-visitor/'.$profilePhoto_link)->destroy();
            
        }
        else {
            $profilePhoto_link = $request->params['data']['profilePhoto'];
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
            'building_ID' => $request->params['data']['building_ID'],
            'email' => $request->params['data']['email'],
            'name' => $request->params['data']['name'],
            'contact' => $request->params['data']['contact'],
            'validId' => $request->params['data']['validId'],
            'profilePhoto' => $profilePhoto_link,
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
