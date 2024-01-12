<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Http\Controllers\Controller;

class EtablissementController extends Controller
{
    //
    
    //index __Liste etablissement
    public function index()
    {
        $etablissements = Etablissement::orderBy('title', 'ASC')->get();
        return view('admin.pages.etablissement.index', compact('etablissements'));
    }

    //store etablissement
    public function store(Request $request)
    {
        //validation
        $data =  $request->validate([
            'title' => 'required',
        ]);

        $etablissement = Etablissement::firstOrCreate([
            'title' => $request['title'],
        ]);

        return back()->with('success', 'Nouvelle Etablissement ajoutée avec success');
    }


    //update etablissement
    public function update(Request $request, string $id)
    {

        $data =  $request->validate([
            'title' => 'required',
        ]);


        Etablissement::whereId($id)->update([
            'title' => $request['title'],
        ]);

        return back()->withSuccess('Etablissement modifiée avec success');
    }


    //delete etablissement
    public function destroy(string $id)
    {
        //
        Etablissement::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
