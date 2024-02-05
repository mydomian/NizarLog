<?php

namespace App\Http\Controllers\Agency;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('agency.pages.dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('agency.login')->with('message','Logout Successfully');
    }
}
