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
use App\Models\CodCharge;
use App\Models\DeliveryCharge;
use App\Models\Hub;
use App\Models\Tracking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = User::where(['login_type'=>'driver','status'=>'active'])->get();
        $hubs = Hub::where(['status'=>'active'])->get();
        $airBookings = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['status'=>'pickup_pending'])->latest()->paginate(50);
        return view('admin.pages.air_bills.index',compact('airBookings','drivers','hubs'));
    }

    public function adminListsAssignDeliveryman(Request $request){
        if($request->isMethod('post')){

            foreach($request->ids as $bookingId){

                $airBooking = AirBooking::find($bookingId);
                $airBooking->status = 'assign_delivery_man';
                $airBooking->save();

                $tracking = new Tracking;
                $tracking->air_booking_id = $bookingId;
                $tracking->driver_id = $request->driver_id;
                $tracking->from_hub_id = null;
                $tracking->to_hub_id = $request->to_hub_id;
                $tracking->status = 'assign_delivery_man';
                $tracking->save();
            }
        }
        $airBookings = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge','tracking')->where(['status'=>'assign_delivery_man'])->latest()->paginate(50);
        $drivers = User::where(['login_type'=>'driver','status'=>'active'])->get();
        $hubs = Hub::where(['status'=>'active'])->get();

        return view('admin.pages.air_bills.asign_deliveryman',compact('airBookings','drivers','hubs'));
    }

    public function adminListsPickupReceived(){

        $airBookings = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge','tracking')->where(['status'=>'received_pickup_pending'])->latest()->paginate(50);
        $drivers = User::where(['login_type'=>'driver','status'=>'active'])->get();
        $hubs = Hub::where(['status'=>'active'])->get();

        return view('admin.pages.air_bills.receive_pickup_pending',compact('airBookings','drivers','hubs'));
    }

    public function adminListsHubStore(Request $request){
        if($request->isMethod('post')){

            foreach($request->ids as $bookingId){

                $airBooking = AirBooking::find($bookingId);
                $airBooking->status = 'transit';
                $airBooking->save();

                $trackingLast = Tracking::where(['air_booking_id'=>$airBooking->id])->latest()->first();
                $tracking = new Tracking;
                $tracking->air_booking_id = $bookingId;
                $tracking->driver_id = $request->driver_id;
                $tracking->from_hub_id = $trackingLast->to_hub_id;
                $tracking->to_hub_id = $request->to_hub_id;
                $tracking->status = 'transit';
                $tracking->save();
            }
        }
        $airBookings = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['status'=>'delivery_hub'])->latest()->paginate(50);
        $drivers = User::where(['login_type'=>'driver','status'=>'active'])->get();
        $hubs = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.air_bills.hub_store',compact('airBookings','drivers','hubs'));
    }

    public function adminListsTransit(Request $request){
        if($request->isMethod('post')){

            if($request->type == 'transit'){
                if(!isset($request->to_hub_id)){
                    return back()->withError('Select Hub');
                }

                foreach($request->ids as $bookingId){
                    $airBooking = AirBooking::find($bookingId);
                    $airBooking->status = 'transit';
                    $airBooking->save();

                    $trackingLast = Tracking::where(['air_booking_id'=>$airBooking->id])->latest()->first();
                    $tracking = new Tracking;
                    $tracking->air_booking_id = $bookingId;
                    $tracking->driver_id = $request->driver_id;
                    $tracking->from_hub_id = $trackingLast->to_hub_id;
                    $tracking->to_hub_id = $request->to_hub_id;
                    $tracking->status = 'transit';
                    $tracking->save();
                }
            }elseif($request->type == 'delivery'){

                foreach($request->ids as $bookingId){
                    $airBooking = AirBooking::find($bookingId);
                    $airBooking->status = 'delivery';
                    $airBooking->save();

                    $trackingLast = Tracking::where(['air_booking_id'=>$airBooking->id])->latest()->first();
                    $tracking = new Tracking;
                    $tracking->air_booking_id = $bookingId;
                    $tracking->driver_id = $request->driver_id;
                    $tracking->from_hub_id = null;
                    $tracking->to_hub_id = null;
                    $tracking->status = 'delivery';
                    $tracking->save();
                }
            }

        }
        $airBookings = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['status'=>'transit'])->latest()->paginate(50);
        $drivers = User::where(['login_type'=>'driver','status'=>'active'])->get();
        $hubs = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.air_bills.transit_list',compact('airBookings','hubs','drivers'));
    }

    public function adminListsDelivered(Request $request){
        $airBookings = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['status'=>'delivery'])->latest()->paginate(50);
        return view('admin.pages.air_bills.delivered_list',compact('airBookings'));
    }

    public function adminListsReturn(Request $request){
        $airBookings = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['status'=>'return'])->latest()->paginate(50);
        return view('admin.pages.air_bills.return_list',compact('airBookings'));
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
        return view('admin.pages.air_bills.create',compact('hubs','areaTypes','parcelTypes','deliveryTypes'));
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
            $tracking = new Tracking;
            $tracking->air_booking_id = $airBooking->id;
            $tracking->air_booking_id = $airBooking->id;
            $tracking->status = 'pickup_pending';
            $tracking->save();
        }

        return redirect()->route('admin.airBillPrint',$airBooking->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $airBill = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->find($id);
        return view('admin.pages.air_bills.show',compact('airBill'));
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

    public function airBillPrint($airBillId){
        $airBill = AirBooking::with('user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->find($airBillId);
        return view('admin.pages.print.air_bill_booking',compact('airBill'));
    }

    public function adminTracking(Request $request){
        if($request->isMethod('post')){
            $airBooking = AirBooking::with('tracking','user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['invoice_no'=>$request->invoice_no])->first();
            if($airBooking){
// return $airBooking;
                return view('admin.pages.air_bills.tracking',compact('airBooking'));


            }else{
                return back()->withError('Tracking Not Found');
            }
        }
        return view('admin.pages.air_bills.tracking');
    }


}
