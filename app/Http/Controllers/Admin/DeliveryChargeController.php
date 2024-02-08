<?php

namespace App\Http\Controllers\Admin;

use App\Models\AreaType;
use App\Models\ParcelType;
use App\Models\DeliveryType;
use Illuminate\Http\Request;
use App\Models\DeliveryCharge;
use App\Http\Controllers\Controller;

class DeliveryChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryCharges = DeliveryCharge::with('delivery_type','parcel_type','area_type')->latest()->paginate(50);
        return view('admin.pages.delivery_charge.index',compact('deliveryCharges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deliveryTypes = DeliveryType::where('status','active')->get();
        $parcelTypes = ParcelType::where('status','active')->get();
        $areaTypes = AreaType::where('status','active')->get();
        return view('admin.pages.delivery_charge.create',compact('areaTypes','parcelTypes','deliveryTypes'));
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
            'area_type_id' => 'required',
            'parcel_type_id' => 'required',
            'weight' => 'required',
            'delivery_charge' => 'required',
        ]);
        $deliveryCharge = new DeliveryCharge;
        $deliveryCharge->delivery_type_id = $request->delivery_type_id;
        $deliveryCharge->area_type_id = $request->area_type_id;
        $deliveryCharge->parcel_type_id = $request->parcel_type_id;
        $deliveryCharge->weight = $request->weight;
        $deliveryCharge->delivery_charge = $request->delivery_charge;
        $deliveryCharge->save();
        return back()->with('message','Delivery Charge Created Successfully');
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
        $parcelTypes = ParcelType::where('status','active')->get();
        $areaTypes = AreaType::where('status','active')->get();
        $deliveryCharge = DeliveryCharge::with('delivery_type')->find($id);
        return view('admin.pages.delivery_charge.edit',compact('deliveryCharge','deliveryTypes','parcelTypes','areaTypes'));
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
            'area_type_id' => 'required',
            'parcel_type_id' => 'required',
            'weight' => 'required',
            'delivery_charge' => 'required',
        ]);
        $deliveryCharge = DeliveryCharge::find($id);
        $deliveryCharge->delivery_type_id = $request->delivery_type_id;
        $deliveryCharge->area_type_id = $request->area_type_id;
        $deliveryCharge->parcel_type_id = $request->parcel_type_id;
        $deliveryCharge->weight = $request->weight;
        $deliveryCharge->delivery_charge = $request->delivery_charge;
        $deliveryCharge->save();
        return back()->with('message','Delivery Charge Updated Successfully');
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

    public function deliveryChargeStatus(Request $request, DeliveryCharge $deliveryCharge){
        $deliveryCharge->status = $request->status;
        $deliveryCharge->save();
        return response()->json([
            'success'=>true
        ]);
    }
}
