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
        $pickup_requests = Tracking::with('driver:id,name','booking:id,spacial_instruction')->where('driver_id', auth()->id())
                                            ->where('status','pickup_pending')
                                            ->whereNotExists(function ($query) {
                                                    $query->select(DB::raw(1))
                                                            ->from('trackings as t2')
                                                            ->whereColumn('t2.air_booking_id', 'trackings.air_booking_id')
                                                            ->where('t2.status', '!=', 'pickup_pending');
                                                    })
                                            ->get();
        return view('driver.pages.pickup.pickup_requests',compact('pickup_requests'));
    }

    public function pickedUp(AirBooking $airBooking){;
           DB::transaction(function () use ($airBooking){
               $tracking = Tracking::create([
                   'air_booking_id' => $airBooking->id,
                   'driver_id' => Auth::id(),
                   'from_hub_id' => null,
                   'to_hub_id' =>null,
                   'destination_address' => null,
                   'status' => 'received_pickup_pending'
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
                // Create new tracking record
                Tracking::create([
                    'air_booking_id' => $id,
                    'driver_id' => Auth::id(),
                    'status' => 'received_pickup_pending'
                ]);
            }

            // Update associated booking statuses
            AirBooking::whereIn('id', $ids)
                ->update(['status' => 'received_pickup_pending']);
        });

        return redirect()->back()->with('message', 'Selected Parcels Were Picked Up.');
    }
}
