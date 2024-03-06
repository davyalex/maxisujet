<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Events\LoginAt;
use App\Models\UserVerify;
use App\Events\NewRegister;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

            //supprime les users ou email is not verified
            User::where('created_at', '<', now()->addDay(1))
                ->where('is_email_verified', 0)
                ->delete();

            //on verifie si l'email entrée  : si  email existe deja dans la base on affiche un message d'erreur sinon on enregistre le nouvel utilisateur
            $user_email_verify = User::whereEmail($request['email'])
                // ->where('is_email_verified', 1)
                ->get();
            $user_username_verify = User::whereUsername($request['username'])
                // ->where('is_email_verified', 1)
                ->get();


            if ($user_email_verify->count() > 0) {
                return back()->withError('Ce email est dejà associé un compte, veuillez utiliser un autre');
            } elseif ($user_username_verify->count() > 0) {
                return back()->withError('Ce nom utilisateur est dejà associé un compte, veuillez utiliser un autre');
            } else {
                $request->validate([
                    'username' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    'profil' => 'required'
                ]);

                $profil = $request['profil']=='autre' ? $request['profil_autre'] : $request['profil'] ;

                $user = User::firstOrCreate([
                    'username' => $request->username,
                    'email' => $request->email,
                    'profil' => $profil,
                    'password' => Hash::make($request->password),
                ]);

                if ($request->role) {
                    $user->assignRole($request->role);
                }
                //
                //on connecte l'utilisateur

                // Auth::login($user);

                // event(new NewRegister(Auth::user()));


                //send email for verify email
                $token = Str::random(64);

                UserVerify::create([
                    'user_id' => $user->id,
                    'token' => $token
                ]);

                Mail::send('front.pages.Auth.auth_email_verify', ['token' => $token], function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject('Email Verification Mail');
                });

                // url vers la page precendente
                $url_previous = $request['url_previous'];

                return redirect()->away($url_previous)->with([
                    // 'success' => "Inscription réussi, Vous avez obtenu" . Auth::user()->point . 'point',
                    'success' => "Vous avez reçu un email, cliquez pour confirmer votre inscription",
                ]);
            }
        }
    }

    //login User
    public function login(Request $request)
    {
        if (request()->method() == 'GET') {
            if (Auth::check()) {
                return redirect()->route('home');
            }
            return view('front.pages.Auth.login');
        } elseif (request()->method() == 'POST') {
            $url_previous = $request['url_previous'];

            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);

            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt((array($fieldType => $request['username'], 'password' => $request['password'])))) {
                event(new LoginAt(Auth::user()));
                return redirect()->route('user_account.dashboard')->withSuccess('connexion reussi,  points ' . Auth::user()->point . '!');
            } else {
                return back()->withError('Identifiant ou mot de passe incorrect');
            }
        }
    }


    //verify auth email

    public function verifyAccount($token)
    {

        $verifyUser = UserVerify::where('token', $token)->first();
        // $message = 'Sorry your email cannot be identified.';

        // on verifie si le user existe a partir du token
        $user_exist = User::whereId($verifyUser['user_id'])->first();
        if (!$user_exist) {
            $message = 'Le lien de verification à expiré , veuillez vous inscrire a nouveau';
            return redirect()->route('user.register')->with('success', $message);
        }


        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->email_verified_at = Carbon::now();

                $verifyUser->user->save();


                $message = "Votre email est verifié , vous pouvez vous connecter";
                Auth::login($user_exist);
                event(new NewRegister(Auth::user()));


                
                return redirect()->route('user_account.dashboard')->withSuccess('connexion reussi,  points ' . Auth::user()->point . '!');
            } else {
                $message = "Votre e-mail est déjà vérifié, Vous pouvez maintenant vous connecter.";
                return redirect()->route('user.login')->with('success', $message);
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
