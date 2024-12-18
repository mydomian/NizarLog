<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\AirBooking;
use App\Models\AreaType;
use App\Models\CodCharge;
use App\Models\DeliveryCharge;
use App\Models\DeliveryType;
use App\Models\Hub;
use App\Models\ParcelType;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AirBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = AirBooking::where('user_id', Auth::id())->latest()->get();
        return view('agency.pages.air_bill.lists',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $hubs = Hub::where(['status'=>'active'])->get();
        $areaTypes = AreaType::where(['status'=>'active'])->get();
        $parcelTypes = ParcelType::where(['status'=>'active'])->get();
        $deliveryTypes = DeliveryType::where(['status'=>'active'])->get();
        return view('agency.pages.air_bill.create',compact('hubs','areaTypes','parcelTypes','deliveryTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $deliveryCharge = DeliveryCharge::find($request->delivery_charge_id);
        $codCharge = CodCharge::where('type','desk_booking')->latest()->first();
        $lastBooking = AirBooking::latest()->first();
        if (!$lastBooking) {
            $invoice = 'NLOG-579845';
        }else {
            $lastInvoiceNumber = explode('-', $lastBooking->invoice_no)[1];
            $newInvoiceNumber = 'NLOG-'.($lastInvoiceNumber + 1);
            $invoice = $newInvoiceNumber;
        }
        $airBooking = new AirBooking;
        $airBooking->invoice_no = $invoice;
        $airBooking->user_id = Auth::id();
        $airBooking->last_destination_id = $request->last_destination_id;
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
        $airBooking->spacial_instruction = $request->spacial_instruction;
        $airBooking->delivery_charge = $deliveryCharge->delivery_charge;
        $total_amount = $request->product_amount + $deliveryCharge->delivery_charge;
        $airBooking->cod_charge = ($total_amount * $codCharge->charge_percent) / 100;
        $airBooking->due_amount  = $request->collection_amount - ($deliveryCharge->delivery_charge + $airBooking->cod_charge);
        $airBooking->date_time = now();
        $airBooking->save();

        if($airBooking){
            $tracking = new Tracking();
            $tracking->air_booking_id = $airBooking->id;
            $tracking->air_booking_id = $airBooking->id;
            $tracking->status = 'pickup_pending';
            $tracking->save();
        }
        Session::put('print', route('agency.airBillPrint',$airBooking->id));
        return redirect()->route('agency-air-bill.create')->with('success','Booking created!');
        // return redirect()->route('agency-air-bill.create', ['urlToOpen' => $urlToOpen])->with('success', 'Booking stored successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $airBill = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->find($id);
        return view('agency.pages.air_bill.show',compact('airBill'));
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

    public function airBillPrint($airBillId){
        $airBill = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->find($airBillId);
        return view('agency.pages.print.air_bill_booking',compact('airBill'));
    }

    
    public function tracking(Request $request){

        if($request->isMethod('post')){
            $airBooking = AirBooking::with('tracking','user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['invoice_no'=>$request->invoice_no])->first();
            if($airBooking){
                return view('agency.pages.air_bill.tracking',compact('airBooking'));
            }else{
                return back()->withError('Tracking Not Found');
            }
        }
        return view('agency.pages.air_bill.tracking');
    }


    public function transitReceive(){
        $transit_receives = Tracking::with('booking.hub')->where('to_hub_id', auth()->id())->where('status','transit_delivered')->get();
        return view('agency.pages.transit.receive', compact('transit_receives'));
    }

    public function confirmReceivedTransit(AirBooking $airBooking){
        $existing_tracking = Tracking::where('air_booking_id', $airBooking->id)->latest()->first();       
        $tracking = Tracking::create([
            'air_booking_id' => $airBooking->id,
            'driver_id'      => Auth::id(),
            'from_hub_id'    => $existing_tracking->from_hub_id,
            'to_hub_id'      =>$existing_tracking->to_hub_id,
            'destination_address' => null,
            'status'         => 'transit_received'
        ]);
    return redirect()->back()->with('message','Transit receive confirmed.');
    }
    
}
