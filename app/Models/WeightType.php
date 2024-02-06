<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightType extends Model
{
    use HasFactory;

    public function delivery_type(){
        return $this->belongsTo(DeliveryType::class);
    }
}
