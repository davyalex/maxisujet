<?php

namespace App\Http\Controllers\backend;

use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NiveauController extends Controller
{
    //
    //index __Liste Niveau
    public function index()
    {
        //liste de tous les niveaux
        $niveaux = Niveau::with('parent')->orderBy('parent_id', 'DESC')->get();
        //liste des niveaux uniquement parent
        $niveaux_parent = Niveau::where('parent_id', null)->orderBy('parent_id', 'DESC')->get();

        // dd($niveaux->toArray());
        return view('admin.pages.niveau.index', compact('niveaux', 'niveaux_parent'));
    }

    //store Niveau
    public function store(Request $request)
    {
        //validation
        $data =  $request->validate([
            'title' => 'required',
        ]);

        $Niveau = Niveau::firstOrCreate([
            'title' => $request['title'],
            'parent_id' => $request['parent_id'],

        ]);

        return back()->with('success', 'Nouveau Niveau ajouté avec success');
    }


    //update Niveau
    public function update(Request $request, string $id)
    {

        $data =  $request->validate([
            'title' => 'required',
        ]);


        Niveau::whereId($id)->update([
            'title' => $request['title'],
            'parent_id' => $request['parent_id'],
        ]);

        return back()->withSuccess('Niveau modifié avec success');
    }


    //delete Niveau
    public function destroy(string $id)
    {
        //
        Niveau::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
