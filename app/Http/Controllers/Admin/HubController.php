<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hub;
use Illuminate\Http\Request;

class HubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hubs = Hub::latest()->paginate(50);
        return view('admin.pages.hub.index',compact('hubs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.hub.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'hub_name' => 'required|string',
        ]);
        $hub = new Hub;
        $hub->hub_name = ucfirst($request->hub_name);
        $hub->save();
        return back()->with('message','Hub Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hub = Hub::find($id);
        return view('admin.pages.hub.edit',compact('hub'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'hub_name' => 'required|string',
        ]);
        $hub = Hub::find($id);
        $hub->hub_name = ucfirst($request->hub_name);
        $hub->save();
        return back()->with('message','Hub Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function hubStatus(Request $request, Hub $hub){
        $hub->status = $request->status;
        $hub->save();
        return response()->json([
            'success'=>true
        ]);
    }
}
