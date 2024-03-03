<?php

use App\Models\User;
use App\Models\Setting;
use App\Models\AirBooking;

function pickup_pending(){
    return AirBooking::where(['status'=>'pickup_pending'])->count();
}
function assign_driver(){
    return AirBooking::where(['status'=>'assign_delivery_man'])->count();
}
function received_pickup_pending(){
    return AirBooking::where(['status'=>'received_pickup_pending'])->count();
}
function delivery_hub(){
    return AirBooking::where(['status'=>'delivery_hub'])->count();
}
function transit(){
    return AirBooking::where(['status'=>'transit'])->count();
}
function delivery(){
    return AirBooking::where(['status'=>'delivery'])->count();
}
function return_percel(){
    return AirBooking::where(['status'=>'return'])->count();
}
function total_agency(){
    return User::where(['login_type'=>'agency','status'=>'active'])->count();
}
function total_driver(){
    return User::where(['login_type'=>'driver','status'=>'active'])->count();
}

function settings(){
    return Setting::first();
}
