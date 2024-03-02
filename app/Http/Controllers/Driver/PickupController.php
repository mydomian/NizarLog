<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\AirBooking;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PickupController extends Controller
{
    public function pickupRequests(){
        $pickup_requests = Tracking::with('driver:id,name','booking:id,invoice_no,spacial_instruction','from_hub:id,address','to_hub:id,address')
                                    ->where('driver_id', auth()->id())
                                    ->where('status','assign_delivery_man')
                                    ->whereNotExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                    ->from('trackings as t2')
                                                    ->whereColumn('t2.air_booking_id', 'trackings.air_booking_id')
                                                    ->where('t2.status', '!=', 'pickup_pending')
                                                    ->where('t2.status', '!=', 'assign_delivery_man');
                                            })
                                    ->get();
        return view('driver.pages.pickup.pickup_requests',compact('pickup_requests'));
    }

    public function pickedUp(AirBooking $airBooking){
           $existing_tracking = Tracking::where('air_booking_id', $airBooking->id)->latest()->first();
           DB::transaction(function () use ($airBooking, $existing_tracking){
               $tracking = Tracking::create([
                   'air_booking_id' => $airBooking->id,
                   'driver_id'      => Auth::id(),
                   'from_hub_id'    => $existing_tracking->from_hub_id,
                   'to_hub_id'      =>$existing_tracking->to_hub_id,
                   'destination_address' => null,
                   'status'         => 'received_pickup_pending'
               ]);

              $tracking->booking()->update([
                  'status' => 'received_pickup_pending'
              ]);
              $tracking->load('booking');

              return $tracking;
          });
         return redirect()->back()->with('message','Parcel Picked Up.');
    }

    public function bulkPickedUp(Request $request){
        if(empty($request->ids)){
            return back()->with('warning','Nothing selected.');
        }

        DB::transaction(function () use ($request) {
            $ids  = explode(',', $request->ids);
            foreach ($ids as $id) {
                $existing_tracking = Tracking::where('air_booking_id', $id)->latest()->first();
                // Create new tracking record
                Tracking::create([
                    'air_booking_id' => $id,
                    'driver_id' => Auth::id(),
                    'from_hub_id'    => $existing_tracking->from_hub_id,
                    'to_hub_id'      =>$existing_tracking->to_hub_id,
                    'destination_address' => null,
                    'status' => 'received_pickup_pending'
                ]);
            }

            // Update associated booking statuses
            AirBooking::whereIn('id', $ids)
                ->update(['status' => 'received_pickup_pending']);
        });

        return redirect()->back()->with('message', 'Selected Parcels Were Picked Up.');
    }

    public function pickupList(){
        $pickedUps = Tracking::with('driver:id,name','booking:id,invoice_no,spacial_instruction','from_hub:id,address','to_hub:id,address')
                                    ->where('driver_id', auth()->id())
                                    ->where('status','received_pickup_pending')
                                    ->whereNotExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                    ->from('trackings as t2')
                                                    ->whereColumn('t2.air_booking_id', 'trackings.air_booking_id')
                                                    ->where(function($subquery){
                                                        $subquery->where('t2.status', '!=', 'pickup_pending')
                                                                 ->where('t2.status', '!=', 'assign_delivery_man')
                                                                 ->where('t2.status', '!=', 'received_pickup_pending');
                                                 });  
                                            })
                                    ->get();
        return view('driver.pages.pickup.pickup_list',compact('pickedUps'));
    }

    public function deliveredToHub(AirBooking $airBooking){
        $existing_tracking = Tracking::where('air_booking_id', $airBooking->id)->latest()->first();
           DB::transaction(function () use ($airBooking, $existing_tracking){
               $tracking = Tracking::create([
                   'air_booking_id' => $airBooking->id,
                   'driver_id'      => Auth::id(),
                   'from_hub_id'    => $existing_tracking->from_hub_id,
                   'to_hub_id'      =>$existing_tracking->to_hub_id,
                   'destination_address' => null,
                   'status'         => 'delivery_hub'
               ]);

              $tracking->booking()->update([
                  'status' => 'delivery_hub'
              ]);
              $tracking->load('booking');

              return $tracking;
          });
         return redirect()->back()->with('message','Parcel delivered to hub.');
    }

    public function bulkDeliveredToHub(Request $request){
        if(empty($request->ids)){
            return back()->with('warning','Nothing selected.');
        }

        DB::transaction(function () use ($request) {
            $ids  = explode(',', $request->ids);
            foreach ($ids as $id) {
                $existing_tracking = Tracking::where('air_booking_id', $id)->latest()->first();
                // Create new tracking record
                Tracking::create([
                    'air_booking_id' => $id,
                    'driver_id' => Auth::id(),
                    'from_hub_id'    => $existing_tracking->from_hub_id,
                    'to_hub_id'      =>$existing_tracking->to_hub_id,
                    'destination_address' => null,
                    'status' => 'delivery_hub'
                ]);
            }

            // Update associated booking statuses
            AirBooking::whereIn('id', $ids)
                ->update(['status' => 'delivery_hub']);
        });

        return redirect()->back()->with('message', 'Selected Parcels Were delivered to hub.');
    }

    public function deliveredToHubList(){
        $delivered = Tracking::with('driver:id,name','booking:id,invoice_no,spacial_instruction','from_hub:id,address','to_hub:id,address')
                                ->where('driver_id', auth()->id())
                                ->where('status','delivery_hub')
                                ->whereNotExists(function ($query) {
                                        $query->select(DB::raw(1))
                                                ->from('trackings as t2')
                                                ->whereColumn('t2.air_booking_id', 'trackings.air_booking_id')
                                                ->where(function($subquery){
                                                    $subquery->where('t2.status', '!=', 'pickup_pending')
                                                            ->where('t2.status', '!=', 'assign_delivery_man')
                                                            ->where('t2.status', '!=', 'received_pickup_pending')
                                                            ->where('t2.status', '!=', 'delivery_hub');
                                            });  
                                        })
                                ->get();
        return view('driver.pages.pickup.delivered_to_hub_list',compact('delivered'));
    }

    public function deliveryRequests(){
        $delivery_requests = Tracking::with('driver:id,name','booking:id,invoice_no,spacial_instruction','from_hub:id,address','to_hub:id,address')
                                    ->where('driver_id', auth()->id())
                                    ->where('status','transit')
                                    ->whereNotExists(function ($query) {
                                            $query->select(DB::raw(1))
                                                    ->from('trackings as t2')
                                                    ->whereColumn('t2.air_booking_id', 'trackings.air_booking_id')
                                                    ->where(function($subquery){
                                                        $subquery->where('t2.status', '!=', 'pickup_pending')
                                                                    ->where('t2.status', '!=', 'assign_delivery_man')
                                                                    ->where('t2.status', '!=', 'received_pickup_pending')
                                                                    ->where('t2.status', '!=', 'delivery_hub')
                                                                    ->where('t2.status', '!=', 'transit');
                                                });   
                                            })
                                    ->get();
        return view('driver.pages.delivery.delivery_requests',compact('delivery_requests'));
    }


   public function transitDelivery(AirBooking $airBooking){
            $existing_tracking = Tracking::where('air_booking_id', $airBooking->id)->latest()->first();       
                $tracking = Tracking::create([
                    'air_booking_id' => $airBooking->id,
                    'driver_id'      => Auth::id(),
                    'from_hub_id'    => $existing_tracking->from_hub_id,
                    'to_hub_id'      =>$existing_tracking->to_hub_id,
                    'destination_address' => null,
                    'status'         => 'transit_delivered'
                ]);
        return redirect()->back()->with('message','Transit delivery confirmed.');
   }


   public function bulkTransitDelivery(Request $request){
        if(empty($request->ids)){
            return back()->with('warning','Nothing selected.');
        }

            $ids  = explode(',', $request->ids);
            foreach ($ids as $id) {
                $existing_tracking = Tracking::where('air_booking_id', $id)->latest()->first();
                // Create new tracking record
                Tracking::create([
                    'air_booking_id' => $id,
                    'driver_id' => Auth::id(),
                    'from_hub_id'    => $existing_tracking->from_hub_id,
                    'to_hub_id'      =>$existing_tracking->to_hub_id,
                    'destination_address' => null,
                    'status' => 'transit_delivered'
                ]);
            }
        return redirect()->back()->with('message', "Selected Parcel's transit delivery confirmed");
   }

    public function tracking(Request $request){

        if($request->isMethod('post')){
            $airBooking = AirBooking::with('tracking','user','hub','area_type','parcel_type','delivery_type','delivery_weight_charge')->where(['invoice_no'=>$request->invoice_no])->first();
            if($airBooking){
                return view('driver.pages.pickup.tracking',compact('airBooking'));
            }else{
                return back()->withError('Tracking Not Found');
            }
        }
        return view('driver.pages.pickup.tracking');
    }
}
