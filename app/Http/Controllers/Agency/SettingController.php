<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use App\Services\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{   
    private $services;

    public function __construct(Services $services)
    {
        $this->services = $services;
    }

    public function setting(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|string',
                'phone' => 'required|numeric',
                'address' => 'required|string|max:255',
                'profile' => 'image|max:512',
                'cv' => 'mimes:pdf|max:100'
            ]);
        $user = User::find(auth()->id());
        $user->update([
             'name' => ucfirst($request->name),
         ]);
        $user_info = UserInfo::where('user_id',$user->id)->first();
        $user_info->update([
            'phone' => $request->phone ?? $user_info->phone,
            'address' => $request->address ?? $user_info->address,
         ]);
         if($request->hasFile('profile')){
            $this->services->imageDestroy($user->profile_photo_path, 'profile/');
            $photo = $this->services->imageUpload($request->file('profile'),'profile/');
            $user->update([
                'profile_photo_path' => $photo
            ]);
         }
         if($request->hasFile('cv')){
            $this->services->imageDestroy($user_info->cv, 'cv/');
            $cv = $this->services->imageUpload($request->file('cv'),'cv/');
            $user_info->update([
                'cv' => $cv
            ]);
         }
        
         return back()->with('success','Profile Updated.');
    }
        $user_info = UserInfo::with('user')->where('user_id',Auth::id())->first();
        return view('agency.pages.settings',compact('user_info'));
    }

    public function checkPassword(Request $request){
        $request->validate([
            'password' => 'required'
        ]);
        $match =  password_verify($request->password, Auth::user()->password);
        if($match){
            Session::put('change-password',true);
            return back();
        }else {
            return back()->withErrors(['password' => "The provided password was incorrect."]);
        }
        
    }

    public function updatePassword(Request $request){
        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'same:new_password',
        ]);
        $user = User::find(auth()->id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        $user_info = UserInfo::where('user_id', auth()->id())->update([
            'pin' => $request->new_password
        ]);

        Session::forget('change-password');
        Auth::logout();
        return redirect()->route('agency.login')->with('message','Password changed successfully.');
    }

    public function cancel(){
        Session::forget('change-password');
        return back();
    }
}
