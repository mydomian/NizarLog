<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Tracking;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function pickupRequests(){
        $pickup_requests = Tracking::with('driver:id,name')->where('driver_id', auth()->id())
                                            ->where('status','pickup_pending')
                                            ->get();
        return view('driver.pages.pickup.pickup_requests',compact('pickup_requests'));
    }

    public function pickedUp(Tracking $tracking){
          $tracking->update([
              'status' => 'received_pickup_pending'
          ]);
         return redirect()->back()->with('message','Parcel Picked Up.');
    }
}
