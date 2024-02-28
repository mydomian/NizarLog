<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function driver(){
        return $this->belongsTo(User::class,'driver_id','id');
    }

    public function booking(){
        return $this->belongsTo(AirBooking::class,'air_booking_id','id');
    }

    public function from_hub(){
        return $this->belongsTo(UserInfo::class,'from_hub_id','id');
    }

    public function to_hub(){
        return $this->belongsTo(UserInfo::class,'to_hub_id','id');
    }
}
