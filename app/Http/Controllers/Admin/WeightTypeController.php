<?php

namespace App\Http\Controllers\Admin;

use App\Models\WeightType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryType;

class WeightTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weightTypes = WeightType::with('delivery_type')->latest()->paginate(50);
        return view('admin.pages.weight_type.index',compact('weightTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deliveryTypes = DeliveryType::where('status','active')->get();
        return view('admin.pages.weight_type.create',compact('deliveryTypes'));
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
            'delivery_type_id' => 'required',
            'type' => 'required|string',
            'charge' => 'required',
        ]);
        $weightType = new WeightType;
        $weightType->delivery_type_id = $request->delivery_type_id;
        $weightType->type = ucfirst($request->type);
        $weightType->charge = $request->charge;
        $weightType->save();
        return back()->with('message','Weight Type Created Successfully');
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
        $deliveryTypes = DeliveryType::where('status','active')->get();
        $weightType = WeightType::with('delivery_type')->find($id);
        return view('admin.pages.weight_type.edit',compact('weightType','deliveryTypes'));
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
            'delivery_type_id' => 'required',
            'type' => 'required|string',
            'charge' => 'required',
        ]);
        $weightType = WeightType::find($id);
        $weightType->delivery_type_id = $request->delivery_type_id;
        $weightType->type = ucfirst($request->type);
        $weightType->charge = $request->charge;
        $weightType->save();
        return back()->with('message','Weight Type Updated Successfully');
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

    public function weightTypeStatus(Request $request, WeightType $weightType){
        $weightType->status = $request->status;
        $weightType->save();
        return response()->json([
            'success'=>true
        ]);
    }
}
