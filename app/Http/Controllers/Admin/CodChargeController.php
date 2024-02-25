<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CodCharge;
use Illuminate\Http\Request;

class CodChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cods = CodCharge::latest()->paginate(50);
        return view('admin.pages.cod_charge.index',compact('cods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.pages.cod_charge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'type' => 'required',
            'charge_percent' => 'required',
        ]);

        $cod = new CodCharge;
        $cod->type = $request->type;
        $cod->charge_percent = $request->charge_percent;
        $cod->save();
        return back()->with('message','COD Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cod = CodCharge::find($id);
        return view('admin.pages.cod_charge.edit',compact('cod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'type' => 'required',
            'charge_percent' => 'required',
        ]);

        $cod = CodCharge::find($id);
        $cod->type = $request->type;
        $cod->charge_percent = $request->charge_percent;
        $cod->save();
        return back()->with('message','Hub Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function CODStatus(Request $request, CodCharge $cod){
        $cod->status = $request->status;
        $cod->save();
        return response()->json([
            'success'=>true
        ]);
    }
}
