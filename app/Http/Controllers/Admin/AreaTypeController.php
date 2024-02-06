<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaType;
use Illuminate\Http\Request;

class AreaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areaTypes = AreaType::latest()->paginate(50);
        return view('admin.pages.area_type.index',compact('areaTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.area_type.create');
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
            'type' => 'required|string',
        ]);
        $areaType = new AreaType;
        $areaType->type = ucfirst($request->type);
        $areaType->save();
        return back()->with('message','Area Type Created Successfully');
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
        $areaType = AreaType::find($id);
        return view('admin.pages.area_type.edit',compact('areaType'));
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
            'type' => 'required|string',
        ]);
        $areaType = AreaType::find($id);
        $areaType->type = ucfirst($request->type);
        $areaType->save();
        return back()->with('message','Area Type Updated Successfully');
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

    public function areaTypeStatus(Request $request, AreaType $areaType){
        $areaType->status = $request->status;
        $areaType->save();
        return response()->json([
            'success'=>true
        ]);
    }

}
