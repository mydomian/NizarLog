<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\AreaType;
use App\Models\DeliveryType;
use App\Models\ParcelType;
use App\Models\ServiceArea;
use Illuminate\Http\Request;

class AirBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $serviceAreas = ServiceArea::where(['status'=>'active'])->get();
        $areaTypes = AreaType::where(['status'=>'active'])->get();
        $parcelTypes = ParcelType::where(['status'=>'active'])->get();
        $deliveryTypes = DeliveryType::where(['status'=>'active'])->get();
        return view('agency.pages.air_bill.create',compact('serviceAreas','areaTypes','parcelTypes','deliveryTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
