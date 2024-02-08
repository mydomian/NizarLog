<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    use HasFactory;

    use HasFactory;

    public function delivery_type(){
        return $this->belongsTo(DeliveryType::class);
    }
    public function area_type(){
        return $this->belongsTo(AreaType::class);
    }
    public function parcel_type(){
        return $this->belongsTo(ParcelType::class);
    }
}
