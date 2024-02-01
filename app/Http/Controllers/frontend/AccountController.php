<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sujet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //user account dasboard
    public function dashboard(){

        

        if (Auth::check()) {
            // get sujet of user downloading
            $user = User::with('sujet_download')->where('id', Auth::user()->id)->first();
    //  dd($user->toArray());

            // get sujet of user
            $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
             ->where('user_id', Auth::user()->id)
            ->get();



            return view('front.pages.account.dashboard', compact('sujets', 'user' ));
        }else{
            return redirect()->route('home');
        }
    }


    //edit
    public function edit(Request $request, $id)
    {

 $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
             ->where('user_id', Auth::user()->id)
            ->get();

        $sujet = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
        ->whereId($id)
        ->first();
        // dd($sujet->toArray());
        return view('front.pages.account.dashboard', compact('sujet'));
    }


}
