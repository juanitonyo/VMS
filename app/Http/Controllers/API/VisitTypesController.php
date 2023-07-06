<?php

namespace App\Http\Controllers\API;

use App\Models\VisitTypes;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\VisitTypesRequest;
use App\Exports\VisitTypesExport;
use Maatwebsite\Excel\Facades\Excel;

class VisitTypesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search){
            $data = VisitTypes::where('name', 'LIKE', '%'.$request->search.'%')->with('buildingTypeName')->paginate(10);
        }
        else {
            $data = VisitTypes::with('buildingTypeName')->paginate(10);
        }
        return $this->sendResponse($data, "All Visit Types in Array");
    }

    public function getVisitTypeArray(){
        $data = VisitTypes::where('status', 1)->get();
        $arr = [];
        foreach($data as $item){
            $arr[] = [
                'value' => $item->id,
                'label' => $item->name,
                'personToVisit' => $item->person_to_visit
            ]; 
        }
        return $this->sendResponse($arr, "All Visit Types in array");
    }

    public function export() 
    {
        return Excel::download(new VisitTypesExport, 'visittypes.xlsx', \Maatwebsite\Excel\Excel::XLSX);
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
    public function store(VisitTypesRequest $request)
    {
        $request['building_type'] = $request["building_type"]['value'];

        $data = VisitTypes::create($request->all());
        return $this->sendResponse($data, "Saved");
    }

    /**
     * Display the specified resource.
     */
    public function show(VisitTypes $visitTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitTypes $visitTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VisitTypesRequest $request, $id)
    {

        $data = VisitTypes::findOrFail($id)->update([
            'name' => $request->params['data']['name'],
            'building_type' => $request->params['data']['building_type'],
            'description' => $request->params['data']['building_type'],
            'person_to_visit' => $request->params['data']['person_to_visit'],
            'visit_approval' => $request->params['data']['visit_approval'],
            'auto_approve' => $request->params['data']['auto_approve'],
            'status' => $request->params['data']['status']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitTypes $visitTypes)
    {
        //
    }
}
