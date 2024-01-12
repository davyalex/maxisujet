<?php

namespace App\Http\Controllers\backend;

use App\Models\Matiere;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatiereController extends Controller
{
    //

    //index __Liste Matiere
    public function index()
    {
        $matieres = Matiere::orderBy('title', 'ASC')->get();
        return view('admin.pages.matiere.index', compact('matieres'));
    }

    //store Matiere
    public function store(Request $request)
    {
        //validation
        $data =  $request->validate([
            'title' => 'required',
        ]);

        $Matiere = Matiere::firstOrCreate([
            'title' => $request['title'],
        ]);

        return back()->with('success', 'Nouvelle Matiere ajoutée avec success');
    }


    //update Matiere
    public function update(Request $request, string $id)
    {

        $data =  $request->validate([
            'title' => 'required',
        ]);


        Matiere::whereId($id)->update([
            'title' => $request['title'],
        ]);

        return back()->withSuccess('Matiere modifiée avec success');
    }


    //delete Matiere
    public function destroy(string $id)
    {
        //
        Matiere::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
