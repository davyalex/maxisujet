<?php

namespace App\Http\Controllers\frontend;

use App\Models\Sujet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function home(){

         $sujet_recents = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement'])->take(6)->get();
        return view('front.pages.home',  compact('sujet_recents'));
    }


    
    
}
