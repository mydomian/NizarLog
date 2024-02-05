<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function adminLogin(Request $request){

        if($request->isMethod('post')){

            if(!auth()->attempt(['email' => $request->email, 'password' => $request->password, 'login_type' => 'admin'])){
                return redirect()->route('admin.login')->with('error','Credentials is invalid');
            }
            return redirect()->route('admin.dashboard')->with('message','Login Successfully');
        }
        return view('admin.auth.login');
    }

    public function agencyLogin(Request $request){

        if($request->isMethod('post')){
            if(!auth()->attempt(['email' => $request->email, 'password' => $request->password, 'login_type' => 'agency'])){
                return redirect()->route('agency.login')->with('error','Credentials is invalid');
            }
            return redirect()->route('agency.dashboard')->with('message','Login Successfully');
        }
        return view('agency.auth.login');
    }

    public function driverLogin(Request $request){

        if($request->isMethod('post')){
            if(!auth()->attempt(['email' => $request->email, 'password' => $request->password, 'login_type' => 'driver'])){
                return redirect()->route('driver.login')->with('error','Credentials is invalid');
            }
            return redirect()->route('driver.dashboard')->with('message','Login Successfully');
        }
        return view('driver.auth.login');
    }
}
