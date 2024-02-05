<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('admin.pages.dashboard');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login')->with('message','Logout Successfully');
    }
}
