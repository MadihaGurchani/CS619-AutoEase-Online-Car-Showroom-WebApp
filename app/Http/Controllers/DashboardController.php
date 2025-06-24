<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //This method will show dashoard page for customer
    public function index(){
        //shows dashboard.blade.php
        return view('dashboard');
    }
}
