<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Settings\HostRequest;
use App\Models\Host;
use Illuminate\Http\Request;

class HostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Host::paginate(10);
        return $this->sendResponse($data, "Fetched all Host in Array");
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
    public function store(HostRequest $request)
    {
        $data = Host::create($request->validated());
        return $this->sendResponse($data, "Saved Data");
    }

    /**
     * Display the specified resource.
     */
    public function show(Host $host)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Host $host)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HostRequest $request, $id)
    {
        $data = Host::findOrFail($id)->update([
            'fname' => $request->params['data']['fname'],
            'lname' => $request->params['data']['lname'],
            'email' => $request->params['data']['email'],
            'password' => $request->params['data']['password'],
            'location' => $request->params['data']['location'],
            'contact' => $request->params['data']['contact'],
            'gov_id' => $request->params['data']['gov_id'],
            'role' => $request->params['data']['role'],
          ]);
          return $this->sendResponse($request->validated(), "Updated Data");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Host $host)
    {
        //
    }
}
