<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CodCharge;
use App\Models\DeliveryCharge;
use App\Models\WeightType;

class DeliveryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryTypes = DeliveryType::latest()->paginate(50);
        return view('admin.pages.delivery_type.index',compact('deliveryTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.delivery_type.create');
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
        $deliveryType = new DeliveryType;
        $deliveryType->type = ucfirst($request->type);
        $deliveryType->save();
        return back()->with('message','Delivery Type Created Successfully');
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
        $deliveryType = DeliveryType::find($id);
        return view('admin.pages.delivery_type.edit',compact('deliveryType'));
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
        $deliveryType = DeliveryType::find($id);
        $deliveryType->type = ucfirst($request->type);
        $deliveryType->save();
        return back()->with('message','Delivery Type Updated Successfully');
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

    public function deliveryTypeStatus(Request $request, DeliveryType $deliveryType){
        $deliveryType->status = $request->status;
        $deliveryType->save();
        return response()->json([
            'success'=>true
        ]);
    }

    public function delTypeWiseWeighType(Request $request){
        $deliveryCharges = DeliveryCharge::where(['delivery_type_id'=>$request->deliveryTypeValue,'area_type_id'=>$request->areaTypeValue,'parcel_type_id'=>$request->parcelTypeValue,'status'=>'active'])->get();
        return $deliveryCharges;
    }

    public function delTypeWiseCodCharge(Request $request){
        $deliveryCharge = DeliveryCharge::find($request->deliveryChargeValue);
        return $deliveryCharge;
    }

    public function CodCharge(Request $request){
        $deliveryCharge = DeliveryCharge::find($request->totalChargeId);
        $charge = $deliveryCharge->delivery_charge;
        $productAmount = $request->productAmount;
        $total_amount = $charge+$productAmount;

        $percent = CodCharge::where('type','desk_booking')->latest()->first();

        $percentageAmount = ($total_amount * $percent->charge_percent) / 100;
        return response()->json([
            'percentageAmount'=> $percentageAmount,
            'deliveryCharge' => $charge
        ]);

    }
}
