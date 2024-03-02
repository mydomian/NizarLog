<?php
use App\Models\Tracking;
use Illuminate\Support\Facades\DB;

function pickupRequest(){
    return Tracking::where('driver_id', auth()->id())
                    ->where('status','assign_delivery_man')
                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                                ->from('trackings as t2')
                                ->whereColumn('t2.air_booking_id', 'trackings.air_booking_id')
                                ->where('t2.status', '!=', 'pickup_pending')
                                ->where('t2.status', '!=', 'assign_delivery_man');
                        })
                    ->count();
}

function totalPickedUp(){
    return Tracking::where('driver_id', auth()->id())
                    ->where('status','received_pickup_pending')->count();
}

function totalDeliveredtoHub(){
    return Tracking::where('driver_id', auth()->id())
                    ->where('status','delivery_hub')->count();
}

function totalPickupRequest(){
    return Tracking::where('driver_id', auth()->id())
                    ->where('status','assign_delivery_man')->count();
}

function isReceived($id){
    return Tracking::where('air_booking_id', $id)->where('status','transit_received')->exists();
}