<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('driver.pages.dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('driver.login')->with('message','Logout Successfully');
    }
}
