<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthAdminController extends Controller
{
    //

    public function listUser()

   
    {
        // $countUser = User::count();
        $users = User::with('roles')->orderBy('created_at', 'DESC')->paginate(50);
        // dd($users->toArray());
        return view('admin.pages.user.index', compact('users'));
    }


    // public function registerForm(Request $request)
    // {
    //     $roles = Role::get();
    //     return view('admin.pages.user.register', compact('roles'));
    // }

    public function store(Request $request)
    {

        $user_verify = User::whereEmail($request['email'])->get();
        // dd($user_verify->count());
        if ($user_verify->count() > 0) {
            return back()->withError('Ce email est dejà associé un compte, veuillez utiliser un autre');
        } else {
            // dd($request);
            $request->validate([
                'username' => 'required',
                'email' => 'required|unique:users',
                // 'password' => 'required',
            ]);

            // $pwd_generate = $request['username'].'@'.Str::random('4');
            $user = User::firstOrCreate([
                'username' => $request['username'],
                'email' => $request->email,
                // 'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);
            if ($request->has('role')) {
                $user->assignRole([$request['role']]);
            }

            // $data = [
            //     "username" =>  $request['username'],
            //     "email" => $request['email'],
            //     "pwd" => $pwd_generate,
            // ];
            // $auth_user_details = Session::put('user_auth', $data);

            return back()->with([
                'success' => "Utilisateur ajouté avec success",
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::with('roles')->whereId($id)->first();
        return view('admin.pages.user.profil.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $user = tap(User::find($id))->update([
            'username' => $request['username'],
            'email' => $request->email,
            // 'role' => $request->role,
            // 'password' => Hash::make($pwd_generate),
        ]);


        if ($request->has('role')) {
            $user->syncRoles($request['role']);
        }
        return back()->with([
            'success' => "Utilisateur modifié avec success",
        ]);
    }


    public function destroy($id)
    {

        User::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }


    public function login(Request $request)
    {
        if (request()->method() == 'GET') {
            return view('admin.pages.user.login');
        } elseif (request()->method() == 'POST') {

            $data = $request->validate([
                'email' => ['required',],
                'password' => ['required'],
            ]);
            if (Auth::attempt($data)) {
                return redirect()->route('dashboard.index')->withSuccess('Connexion réussi,  Bienvenue  ' . Auth::user()->name);
            } else {
                return back()->withError('Email ou mot de passe incorrect');
            }
        }
    }

    //logout
    public function logout()
    {
        Auth::logout();
        Session::forget('user_auth');
        return Redirect('sign-in')->withSuccess('deconnexion réussi');
    }
}
