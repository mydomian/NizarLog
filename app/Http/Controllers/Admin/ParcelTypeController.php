<?php

namespace App\Http\Controllers\Admin;

use App\Models\ParcelType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParcelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcelTypes = ParcelType::latest()->paginate(50);
        return view('admin.pages.parcel_type.index',compact('parcelTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.parcel_type.create');
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
        $parcelType = new ParcelType;
        $parcelType->type = ucfirst($request->type);
        $parcelType->save();
        return back()->with('message','Parcel Type Created Successfully');
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
        $parcelType = ParcelType::find($id);
        return view('admin.pages.parcel_type.edit',compact('parcelType'));
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
        $parcelType = ParcelType::find($id);
        $parcelType->type = ucfirst($request->type);
        $parcelType->save();
        return back()->with('message','Parcel Type Updated Successfully');
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

    public function parcelTypeStatus(Request $request, ParcelType $parcelType){
        $parcelType->status = $request->status;
        $parcelType->save();
        return response()->json([
            'success'=>true
        ]);
    }
}
