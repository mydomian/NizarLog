<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hub;
use App\Models\ServiceArea;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    private $services;
    public function __construct(Services $services)
    {
        $this->services = $services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = User::with('user_info')->where(['login_type'=>'driver'])->latest()->paginate(50);
        return view('admin.pages.driver.index',compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.driver.create',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'service_area' => 'required',
            'pin' => 'required',
            'profile' => 'required',
            'cv' => 'required',
        ]);
        $user = new User;
        $user->name = ucfirst($request->name);
        $user->email = $request->email;
        $user->password = Hash::make($request->pin);
        if ($request->hasFile('profile')) $user->profile_photo_path = $this->services->imageUpload($request->file('profile'), '/profile/');
        $user->login_type = 'driver';
        $user->save();
        $userInfo = new UserInfo;
        $userInfo->user_id = $user->id;
        $userInfo->phone = $request->phone;
        $userInfo->address = $request->address;
        $userInfo->service_area = $request->service_area;
        if ($request->hasFile('cv')) $userInfo->cv = $this->services->imageUpload($request->file('cv'), 'cv/');
        $userInfo->pin = $request->pin;
        $userInfo->save();
        return back()->with('message','Driver Created Successfully');
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
        $driver = User::with('user_info')->find($id);
        $areas = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.driver.edit',compact('driver','areas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'service_area' => 'required',
            'pin' => 'required',
            'profile' => 'nullable',
            'cv' => 'nullable',
        ]);
        $user = User::find($id);
        $user->name = ucfirst($request->name);
        $user->email = $request->email;
        $user->password = Hash::make($request->pin);
        if ($request->hasFile('profile')) $this->services->imageDestroy($user->profile_photo_path, 'profile/');
        if ($request->hasFile('profile')) $user->profile_photo_path = $this->services->imageUpload($request->file('profile'), 'profile/');

        $user->save();
        $userInfo = UserInfo::where('user_id',$id)->first();
        $userInfo->phone = $request->phone;
        $userInfo->address = $request->address;
        $userInfo->service_area = $request->service_area;
        if ($request->hasFile('cv')) $this->services->imageDestroy($userInfo->cv, 'cv/');
        if ($request->hasFile('cv')) $userInfo->cv = $this->services->imageUpload($request->file('cv'), 'cv/');
        $userInfo->pin = $request->pin;
        $userInfo->save();
        return back()->with('message','Driver Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function driverStatus(Request $request, User $user){
        $user->status = $request->status;
        $user->save();
        return response()->json([
            'success'=>true
        ]);
    }
}
