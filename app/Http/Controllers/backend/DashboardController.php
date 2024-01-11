<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //redirect index dashboard
    public function index(){
        return view('admin.pages.dashboard_home');
        }
    
}
