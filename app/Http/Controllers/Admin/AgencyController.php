<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserInfo;
use App\Services\Services;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hub;
use Illuminate\Support\Facades\Hash;

class AgencyController extends Controller
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
        $agencies = User::with('user_info')->where(['login_type'=>'agency'])->latest()->paginate(50);
        return view('admin.pages.agency.index',compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.agency.create',compact('areas'));
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
            'licence' => 'required',
        ]);
        $user = new User;
        $user->name = ucfirst($request->name);
        $user->email = $request->email;
        $user->password = Hash::make($request->pin);
        if ($request->hasFile('profile')) $user->profile_photo_path = $this->services->imageUpload($request->file('profile'), '/profile/');
        $user->login_type = 'agency';
        $user->save();
        $userInfo = new UserInfo;
        $userInfo->user_id = $user->id;
        $userInfo->phone = $request->phone;
        $userInfo->address = $request->address;
        $userInfo->service_area = $request->service_area;
        if ($request->hasFile('licence')) $userInfo->cv = $this->services->imageUpload($request->file('licence'), 'licence/');
        $userInfo->pin = $request->pin;
        $userInfo->save();
        return back()->with('message','Agency Created Successfully');
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
        $agency = User::with('user_info')->find($id);
        $areas = Hub::where(['status'=>'active'])->get();
        return view('admin.pages.agency.edit',compact('agency','areas'));
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
            'licence' => 'nullable',
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
        if ($request->hasFile('licence')) $this->services->imageDestroy($userInfo->cv, 'licence/');
        if ($request->hasFile('licence')) $userInfo->cv = $this->services->imageUpload($request->file('licence'), 'licence/');
        $userInfo->pin = $request->pin;
        $userInfo->save();
        return back()->with('message','Agency Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function agencyStatus(Request $request, User $user){
        $user->status = $request->status;
        $user->save();
        return response()->json([
            'success'=>true
        ]);
    }
}
