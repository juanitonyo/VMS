<?php

namespace App\Http\Controllers\API;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\BuildingRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use App\Jobs\SyncUnitOwnersJob;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\SyncUnitOwnersEvent;
use App\Models\BuildingTypes;
use App\Exports\BuildingExport;
use Maatwebsite\Excel\Facades\Excel;

class BuildingController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Str::lower($request->search) == 'active') {
            $request['search'] = '1';
        }
        else if(Str::lower($request->search) == 'inactive') {
            $request['search'] = '0';
        }
        if ($request->search) {

            $data = Building::where('building_name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('status', $request->search)
                ->orderBy('building_name', 'asc')
                ->paginate($request->limit);

            return $this->sendResponse($data, 'Queued data in table');
        }
        // $data = Building::with('building_type')->paginate(10);
        $relationship = 'buildingType';
        $data = Building::query()
            ->when(Building::with('buildingType')->get(), function ($query) use ($relationship) {
                return $query->with($relationship)->orderBy('building_name', 'asc');
            })
            ->paginate($request->limit);
        return $this->sendResponse($data, "All buildings in array");
    }

    public function export() 
    {
        return Excel::download(new BuildingExport, 'building.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    // get specific building
    public function getBuilding(Request $request)
    {

        $data = Building::with('buildingType')->where('qr_id', $request->buildingUUID)->first();

        return $this->sendResponse($data, "All buildings in array");
    }

    // get active buildings
    public function getBuildingsArray()
    {
        $data = Building::where('status', 1)->get();

        $array = [];

        foreach ($data as $item) {
            $array[] = [
                'value' => $item->id,
                'label' => $item->building_name
            ];
        }
        return $this->sendResponse($array, "All buildings in array");
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
    public function store(BuildingRequest $request)
    {
        $logo_link = "";
        $validated = $request->validated();

        if ($request->logo) {
            $logo_binary = $request->logo;
            $logo_link = time() . '.' . explode('/', explode(':', substr($logo_binary, 0, strpos($logo_binary, ';')))[1])[1];

            if (!File::exists('uploads/images/' . $logo_link)) {
                \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/' . $logo_link)->destroy();
            }

            $validated['logo'] = $logo_link;
        }

        $data = Building::create($validated);
        return $this->sendResponse($logo_link, "Saved Data");
    }



    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BuildingRequest $request, $id)
    {

        $logo_link = "";
        $data = Building::findOrFail($id);

        if ($request->params['data']['logo']) {
            $logo_binary = $request->params['data']['logo'];

            if ($data->logo != $request->params['data']['logo']) {
                $logo_link = time() . '.' . explode('/', explode(':', substr($logo_binary, 0, strpos($logo_binary, ';')))[1])[1];
            } else {
                $logo_link = $request->params['data']['logo'];
            }

            if (!File::exists('uploads/images/' . $logo_link)) { //does not exists
                \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/' . $logo_link)->destroy();
                $data->update([
                    'logo' => $logo_link,
                ]);
            } else if ($data->logo != $logo_link) { // is existing
                unlink('uploads/images/' . $data->logo);
                \Image::make($logo_binary)->fit(200, 200)->save('uploads/images/' . $logo_link)->destroy();
                $data->update([
                    'logo' => $logo_link,
                ]);
            }
        }

        $data->update([
            'building_name' => $request->params['data']['building_name'],
            'description' => $request->params['data']['description'],
            'address' => $request->params['data']['address'],
            'building_type' => $request->params['data']['building_type'],
            'status' => $request->params['data']['status'],
            'health_form' => $request->params['data']['health_form'],
        ]);


        return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        //
    }

    public function syncBuilding(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                Rule::unique('buildings', 'building_name')
            ],
        ]);

        if ($validator->fails()) {
            return $this->sendError([], " The entry for \"" . $request->name . "\" already exists in the records.");
        }

        $data = Building::create([
            'proptech_id' => $request->id,
            'building_name' => $request->name,
            'building_type' => 1,
            'registration_name' => $request->registration_name,
            'address' => $request->full_address ?? "",
        ]);

        return $this->sendResponse($data, "The \"" . $request->name . "\" has been successfully created.");
    }

    public function syncUnitOwners(Request $request)
    {
        // $data = Http::get('http://proptech-api.test/api/vms/sync-unit-owners');
        // $res = $data->body();

        // $records = json_decode($res, true); 

        // $chunks = array_chunk($records, 500);

        // foreach ($chunks as $chunk) {
        //     SyncUnitOwnersJob::dispatch($chunk)->onQueue('unitowners');
        // }
        // return $this->sendResponse([], 'Data save job dispatched');
        //    $data = $request->get('data');  
        SyncUnitOwnersJob::dispatch($request->get('data'))->onQueue('unitowners');
        $count = DB::select("
                SELECT COUNT(*) as user_count
                FROM users
                WHERE created_at >= ?
            ", [$request->get('date_generated')]);

        $userCount = $count[0]->user_count;

        event(new SyncUnitOwnersEvent([
            'user_initial_count' => $userCount,
            'user_total_count' => $request->get('total_length')
        ]));

        return $this->sendResponse([
            'user_initial_count' => $userCount,
            'user_total_count' => $request->get('total_length')
        ], 'Data save job dispatched');
    }

    public function getUnitOwnersLength()
    {
        $data = Http::get('http://proptech-api.test/api/vms/sync-unit-owners');
        $res = $data->body();

        return $this->sendResponse(count(json_decode($res)), 'Unit Owners');
    }
}
