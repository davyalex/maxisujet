<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Events\LoginAt;
use App\Models\UserVerify;
use App\Events\NewRegister;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\RegisterEmailAdmin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
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

            //on verifie si l'email entrée  : si  email existe deja dans la base on affiche un message d'erreur sinon on enregistre le nouvel utilisateur
            $user_email_verify = User::whereEmail($request['email'])
                ->get();

            $user_username_verify = User::whereUsername($request['username'])
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

                $profil = $request['profil'] == 'autre' ? $request['profil_autre'] : $request['profil'];

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

                return redirect()->route('user_account.dashboard')->withSuccess('Vous etes bien connecté,  Le total de vos points est  ' . Auth::user()->point . '!');
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

                //send email to all user admin
                $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'administrateur'))->get();

                foreach ($admin as $user) {
                    Mail::to($user->email)->send(new RegisterEmailAdmin($user));
                }

                return redirect()->route('user_account.dashboard')->withSuccess('Vous etes bien connecté,  Le total de vos points est  ' . Auth::user()->point . '!');
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





    /******************************************* start FORGET PASSWORD************************************* */

    //get form for send email
    public function showForgetPasswordForm(Request $request)
    {
        return view('front.pages.Auth.forgetPassword.email_reset');
    }

    //send  mail with link reset password
    public function submitForgetPasswordForm(Request $request)
    {

        $mail_verify = User::whereEmail($request['email'])
            ->first();
        if (!$mail_verify) {
            return back()->withError('Ce email n\'existe pas');
        } else {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            DB::table('password_reset_tokens')->whereEmail($request['email'])->delete();

            $token = Str::random(64);

            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('front.pages.Auth.forgetPassword.email_send', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('réinitialiser son mot de passe');
            });

            return back()->with('success', 'Nous avons envoyé par e-mail le lien de réinitialisation de votre mot de passe !');
        }
    }

    //form for new password

    public function showResetPasswordForm(Request $request)
    {
        $token  = request('token');

        $verifyTokenExist = DB::table('password_reset_tokens')
            ->where([
                // 'email' => $request->email,
                'token' => $token
            ])
            ->first();

        if ($verifyTokenExist) {
            //checking the time of token is expired or not

            $currentTime = Carbon::now();
            $timeWhenTokenCreated = Carbon::parse($verifyTokenExist->created_at);

            $difference = $currentTime->diffInMinutes($timeWhenTokenCreated);

            if ($difference >  15) {
                DB::table('password_reset_tokens')->where(['token' => $token])->delete();

                return redirect()->route('user.login')->withError('Le lien de reinitialisation à expiré');
            } else {
                return view('front.pages.Auth.new_password_reset');
            }
        } else {
            return redirect()->route('user.login')->withError('Le lien de reinitialisation à expiré');
        }
    }



    //store  the new password in database and redirect to login page
    public function submitResetPasswordForm(Request $request)
    {

        $request->validate([
            // 'email' => 'required|email|exists:users',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        $verifyTokenExist = DB::table('password_reset_tokens')
            ->where([
                // 'email' => $request->email,
                'token' => $request->token
            ])
            ->first();



        if (!$verifyTokenExist) {
            return back()->withError('Token invalid');
        } else {
            $user = User::where('email', $verifyTokenExist->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::table('password_reset_tokens')->where(['token' => $request->token])->delete();

            return redirect(route('user.login'))->withSuccess('Votre mot de passe a été réinitialisé avec succès ! Connectez-vous maintenant');
        }
    }















    /******************************************* end FORGET PASSWORD************************************* */
}
