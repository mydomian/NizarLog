<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirBooking extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo(User::class)->with('user_info');
    }
    public function service_area(){
        return $this->belongsTo(ServiceArea::class);
    }
    public function area_type(){
        return $this->belongsTo(AreaType::class);
    }
    public function parcel_type(){
        return $this->belongsTo(ParcelType::class);
    }
    public function delivery_type(){
        return $this->belongsTo(DeliveryType::class);
    }
    public function delivery_weight_charge(){
        return $this->belongsTo(DeliveryCharge::class,'delivery_charge_id');
    }
}
