<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Services\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    private $services;
    public function __construct(Services $services)
    {
        $this->services = $services;
    }
    public function settings(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'name'      => 'required|string',
                'phone'     => 'required',
                'email'     => 'required|email',
                'address'   => 'required|string'
            ]);
            $settings = Setting::first();

            $settings->update([
                'name'      => $request->name ?? $settings->name,
                'phone'     => $request->phone ?? $settings->phone,
                'email'     => $request->email ?? $settings->email,
                'address'   => $request->address ?? $settings->address,
            ]);
            if($request->hasFile('logo')) {
                $this->services->imageDestroy($settings->logo,'/');
                $logo  = $this->services->imageUpload($request->file('logo'),'/');
                $settings->update([
                    'logo' => $logo,
                ]);
            };
            if($request->hasFile('favicon')){
                $this->services->imageDestroy($settings->favicon,'/');
                $favicon = $this->services->imageUpload($request->file('favicon'),'/');
                $settings->update([
                    'favicon' => $favicon
                ]);
            }
            return back()->with('message','Settings Updated');
        }
        return view('admin.pages.settings');
    }


}
