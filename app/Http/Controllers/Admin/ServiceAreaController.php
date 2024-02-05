<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServiceArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServiceAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serviceAreas = ServiceArea::latest()->paginate(50);
        return view('admin.pages.service_area.index',compact('serviceAreas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.service_area.create');
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
            'name' => 'required|string',
            'code' => 'required|string',
        ]);
        $area = new ServiceArea;
        $area->name = ucfirst($request->name);
        $area->code = $request->code;
        $area->save();
        return back()->with('message','Area Created Successfully');
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
        $serviceArea = ServiceArea::find($id);
        return view('admin.pages.service_area.edit',compact('serviceArea'));
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
            'name' => 'required|string',
            'code' => 'required|string',
        ]);
        $area = ServiceArea::find($id);
        $area->name = ucfirst($request->name);
        $area->code = $request->code;
        $area->save();
        return back()->with('message','Area Updated Successfully');
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

    public function serviceAreaStatus(Request $request, ServiceArea $serviceArea){
        $serviceArea->status = $request->status;
        $serviceArea->save();
        return response()->json([
            'success'=>true
        ]);
    }

}
