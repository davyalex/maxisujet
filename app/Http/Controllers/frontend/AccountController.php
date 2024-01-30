<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //user account dasboard
    public function dashboard(){
        if (Auth::check()) {
            return view('front.pages.account.dashboard');
        }else{
            return redirect()->route('home');
        }
    }
}
