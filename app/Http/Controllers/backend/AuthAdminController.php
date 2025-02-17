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
use Yajra\DataTables\Facades\DataTables;

class AuthAdminController extends Controller
{
    //

    public function index(Request $request)


    {
        // $countUser = User::count();
        // $users = User::with('roles')->orderBy('created_at', 'DESC')->paginate(10);

        if ($request->ajax()) {
            $users = User::with('roles')->select('id', 'username', 'email', 'created_at');

            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->addColumn('actions', function ($user) {
                    return '

                     <a href="' . route('user.editUser', $user->id) . '">
                    <i class="fas fa-edit fs-20" style="font-size: 20px;"></i>
                </a>

                     <a href="#" class="delete" role="button"
                    data-id="' . $user->id . '"><i class="fas fa-trash text-danger"
                    style="font-size: 20px;"></i></a>
                    ';
                })

                ->rawColumns(['actions'])
                ->make(true);
        }

        // dd($users->toArray());
        return view('admin.pages.user.index');
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

    public function editMyAccount($id)
    {
        $user = User::with('roles')->whereId($id)->first();
        return view('admin.pages.user.profil.edit', compact('user'));
    }

    public function editUser($id)
    {
        $user = User::with('roles')->whereId($id)->first();
        return view('admin.pages.user.edit', compact('user'));
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
