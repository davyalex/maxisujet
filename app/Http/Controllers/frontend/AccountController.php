<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sujet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //user account dasboard
    public function dashboard()
    {



        if (Auth::check()) {
            // get sujet of user downloading
            $user = User::with('sujet_download')->where('id', Auth::user()->id)->first();
            //  dd($user->toArray());

            // get sujet of user
            $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
                ->where('user_id', Auth::user()->id)
                ->get();



            return view('front.pages.account.dashboard', compact('sujets', 'user'));
        } else {
            return redirect()->route('home');
        }
    }


    //edit sujet
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


    //edit profil and update profil
    public function editProfil()
    {
        return view('front.pages.account.profil.profil');
    }

    public function updateProfilInfo(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'profil' => 'required'
        ]);

        $profil = $request['profil'] == 'autre' ? $request['profil_autre'] : $request['profil'];

        $user = User::whereId(Auth::user()->id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'profil' => $profil,
        ]);

        return redirect()->route('user_account.dashboard')->with('success', 'Votre compte à éte modifié avec success');
    }


    //update password
    public function updateProfilPwd(request $request)
    {
        // dd($request->toArray());
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "L'ancien mot de passe ne correspond pas !");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('user_account.dashboard')->with("success", "Le mot de passe a été changé avec succès!");
    }
}
