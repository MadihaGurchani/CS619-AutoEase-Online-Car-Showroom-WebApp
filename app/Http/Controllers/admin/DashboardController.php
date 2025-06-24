<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //This method will show dashoard page for admin
    public function index(){
        //shows dashboard.blade.php
        return view('admin.dashboard');
    }
}
