<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    //index __Liste category
    public function index(){
        return view('admin.pages.categorie.index');

    }

}
