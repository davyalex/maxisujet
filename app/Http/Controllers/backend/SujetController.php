<?php

namespace App\Http\Controllers\backend;

use App\Models\Sujet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SujetController extends Controller
{
    //index
    public function index()
    {
        $sujets = Sujet::with(['niveaux', 'matieres','categorie','etablissement'])->get();
        // dd($sujets->toArray());
        return view('admin.pages.sujet.index', compact('sujets'));
    }


    public function store(Request $request)
    {
        // dd($request->toArray());

        $uuid = Str::uuid()->toString();

        if ($request->hasFile('sujet_file')) {
            $fileNameSujet =  $uuid . '.' . $request->sujet_file->extension();
            $request->sujet_file->storeAs('public/', $fileNameSujet);
        }

        if ($request->hasFile('corrige_file')) {
            $fileNameCorrige =  $uuid . '.' . $request->corrige_file->extension();
            $request->corrige_file->storeAs('public/', $fileNameCorrige);
        }

        $sujet = Sujet::firstOrCreate([
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'annee' => $request['annee'],
            'etablissement_id' => $request['etablissement_id'],
            'sujet_file' =>$fileNameSujet  ,
            'corrige_file' => $fileNameCorrige,
        ]);

      
    
        if ($request->has('niveaux')) {

            $sujet->niveaux()->attach($request['niveaux']);
        }

        if ($request->has('matieres')) {

            $sujet->matieres()->attach($request['matieres']);
        }

        return back()->with('success', 'Nouveau sujet crée avec success');
    }
}
