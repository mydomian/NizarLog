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
        $hubs = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.hub.create',compact('hubs'));
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
            'hub_parent' => 'nullable',
            'hub_name' => 'required|string',
            'hub_code' => 'required',
        ]);
        $hub = new Hub;
        $hub->hub_parent = ucfirst($request->hub_parent);
        $hub->hub_name = ucfirst($request->hub_name);
        $hub->hub_code = $request->hub_code;
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
        $hubData = Hub::find($id);
        $hubs = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.hub.edit',compact('hubData','hubs'));
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
            'hub_parent' => 'nullable',
            'hub_name' => 'required|string',
            'hub_code' => 'required',
        ]);
        $hub = Hub::find($id);
        $hub->hub_parent = ucfirst($request->hub_parent);
        $hub->hub_name = ucfirst($request->hub_name);
        $hub->hub_code = $request->hub_code;
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
