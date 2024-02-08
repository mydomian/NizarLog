<?php

namespace App\Http\Controllers\Admin;

use App\Models\AreaType;
use App\Models\AirBooking;
use App\Models\ParcelType;
use App\Models\WeightType;
use App\Models\ServiceArea;
use App\Models\DeliveryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeliveryCharge;
use App\Models\Tracking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $serviceAreas = ServiceArea::where(['status'=>'active'])->get();
        $areaTypes = AreaType::where(['status'=>'active'])->get();
        $parcelTypes = ParcelType::where(['status'=>'active'])->get();
        $deliveryTypes = DeliveryType::where(['status'=>'active'])->get();
        return view('admin.pages.air_bills.create',compact('serviceAreas','areaTypes','parcelTypes','deliveryTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $deliveryCharge = DeliveryCharge::find($request->delivery_charge_id);
        $lastBooking = AirBooking::latest()->first();
        if (!$lastBooking) {
            $invoice = 'NLOG-579845';
        } else {
            $lastInvoiceNumber = explode('-', $lastBooking->invoice_no)[1];
            $newInvoiceNumber = 'NLOG-'.($lastInvoiceNumber + 1);
            $invoice = $newInvoiceNumber;
        }
        $airBooking = new AirBooking;
        $airBooking->invoice_no = $invoice;
        $airBooking->user_id = Auth::id();
        $airBooking->service_area_id = $request->service_area_id;
        $airBooking->area_type_id = $request->area_type_id;
        $airBooking->parcel_type_id = $request->parcel_type_id;
        $airBooking->delivery_type_id = $request->delivery_type_id;
        $airBooking->delivery_charge_id = $request->delivery_charge_id;
        $airBooking->from_name = $request->from_name;
        $airBooking->from_number = $request->from_number;
        $airBooking->from_address = $request->from_address;
        $airBooking->to_name = $request->to_name;
        $airBooking->to_number = $request->to_number;
        $airBooking->to_address = $request->to_address;
        $airBooking->product_details = $request->product_details;
        $airBooking->product_amount = $request->product_amount;
        $airBooking->collection_amount = $request->collection_amount;
        $airBooking->due_amount  = $request->collection_amount - $deliveryCharge->delivery_charge;
        $airBooking->spacial_instruction = $request->spacial_instruction;
        $airBooking->delivery_charge = $deliveryCharge->delivery_charge;
        $airBooking->date_time = now();
        $airBooking->save();

        if($airBooking){
            $tracking = new Tracking;
            $tracking->air_booking_id = $airBooking->id;
            $tracking->air_booking_id = $airBooking->id;
            $tracking->status = 'pickup_pending';
            $tracking->save();
        }
        return back()->with('message','Air Booking Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
