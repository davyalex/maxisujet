<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //
    
    //index __Liste Role
    public function index()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('admin.pages.role.index', compact('roles'));
    }

    //store Role
    public function store(Request $request)
    {
        //validation
        $data =  $request->validate([
            'name' => 'required',
        ]);

        $role = Role::firstOrCreate([
            'name' => $request['name'],
        ]);

        return back()->with('success', 'Nouvelle Role ajoutée avec success');
    }


    //update Role
    public function update(Request $request, string $id)
    {

        $data =  $request->validate([
            'name' => 'required',
        ]);


        Role::whereId($id)->update([
            'name' => $request['name'],
        ]);

        return back()->withSuccess('Role modifiée avec success');
    }


    //delete Role
    public function destroy(string $id)
    {
        //
        Role::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
