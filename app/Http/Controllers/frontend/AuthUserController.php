<?php

namespace App\Http\Controllers\frontend;

use App\Events\LoginAt;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    //register  user 
    public function register(Request $request)
    {
        if (request()->method() == 'GET') {
            if (Auth::check()) {
                return redirect()->route('home');
            }
            return view('front.pages.Auth.register');
        } elseif (request()->method() == 'POST') {

            //on verifie si l'email entrée  : si  email existe deja dans la base on affiche un message d'erreur sinon on enregistre le nouvel utilisateur
            $user_verify = User::whereEmail($request['email'])->get();
            if ($user_verify->count() > 0) {
                return back()->withError('Ce email est dejà associé un compte, veuillez utiliser un autre');
            } else {
                $request->validate([
                    'username' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                ]);

                $user = User::firstOrCreate([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                if ($request->role) {
                    $user->assignRole($request->role);
                }
                //
                //on connecte l'utilisateur
                Auth::login($user);

                event(new LoginAt($user));

                // url vers la page precendente
                $url_previous = $request['url_previous'];

                return redirect()->away($url_previous)->with([
                    'success' => "Inscription réussi",
                ]);
            }
        }
    }

    //login User
    public function login(Request $request){

        if (request()->method() =='GET') {
            if (Auth::check()) {
                return redirect()->route('home');
            }
            return view('front.pages.Auth.login');
        }
        elseif (request()->method() == 'POST') {
            $url_previous = $request['url_previous'];

            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);

            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt((array($fieldType => $request['username'], 'password' => $request['password'])))) {
                event(new LoginAt(Auth::user()));
                return redirect()->away($url_previous)->withSuccess('connexion reussi');
            } else {
                return back()->withError('Identifiant ou mot de passe incorrect');
            }
            
        }

    }


    //logout
    public function logout()
    {
        Auth::logout();
        return Redirect()->route('user.login')->withSuccess('deconnexion réussi');
    }

}
