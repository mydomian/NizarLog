<?php
use App\Models\Tracking;


function pickupRequest(){
    return Tracking::where('driver_id', auth()->id())->where('status','pickup_pending')->count();
}
