<?php

namespace App\Http\Controllers\backend;

use App\Models\Sujet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SujetController extends Controller
{
    //index
    public function index()
    {
        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement'])->get();
        // dd($sujets->toArray());
        return view('admin.pages.sujet.index', compact('sujets'));
    }


    public function store(Request $request)
    {
        // dd($request->toArray());

        $uuid1 = Str::uuid()->toString();
        $uuid2 = Str::uuid()->toString();


        if ($request->hasFile('sujet_file')) {
            $fileNameSujet =  $uuid1 . '.' . $request->sujet_file->extension();
            $request->sujet_file->storeAs('public/', $fileNameSujet);
        }

        if ($request->hasFile('corrige_file')) {
            $fileNameCorrige =  $uuid2 . '.' . $request->corrige_file->extension();
            $request->corrige_file->storeAs('public/', $fileNameCorrige);
        }

        $sujet = Sujet::firstOrCreate([
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'annee' => $request['annee'],
            'etablissement_id' => $request['etablissement_id'],
            'sujet_file' => $fileNameSujet,
            'corrige_file' => $fileNameCorrige,
        ]);


        //insert data in pivot table
        if ($request->has('niveaux')) {

            $sujet->niveaux()->attach($request['niveaux']);
        }

        if ($request->has('matieres')) {

            $sujet->matieres()->attach($request['matieres']);
        }

        return back()->with('success', 'Nouveau sujet crée avec success');
    }


    //edit
    public function edit(Request $request, $id)
    {
        $sujet = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement'])
        ->whereId($id)
        ->first();
        // dd($sujet->toArray());
        return view('admin.pages.sujet.edit', compact('sujet'));
    }
        



    //update sujet

    public function update(Request $request, string $id)
    {

        $uuid1 = Str::uuid()->toString();
        $uuid2 = Str::uuid()->toString();


        if ($request->hasFile('sujet_file')) {
            $fileNameSujet =  $uuid1 . '.' . $request->sujet_file->extension();
            $request->sujet_file->storeAs('public/', $fileNameSujet);
            if ($request['sujet_file_exist']) {
                Storage::delete('public/' . $request['sujet_file_exist']);
            }
        } else {
            $fileNameSujet = $request['sujet_file_exist'];
        }

        if ($request->hasFile('corrige_file')) {
            $fileNameCorrige =  $uuid2 . '.' . $request->corrige_file->extension();
            $request->corrige_file->storeAs('public/', $fileNameCorrige);
            if ($request['corrige_file_exist']) {
                Storage::delete('public/' . $request['corrige_file_exist']);
            }
        } else {
            $fileNameCorrige = $request['corrige_file_exist'];
        }

        // dd($fileNameSujet,$fileNameCorrige);


        $sujet = tap(Sujet::find($id))->update([
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'annee' => $request['annee'],
            'etablissement_id' => $request['etablissement_id'],
            'sujet_file' => $fileNameSujet,
            'corrige_file' => $fileNameCorrige,
        ]);

        //update pivot table
        if ($request->has('niveaux')) {
            $sujet->niveaux()->detach();
            $sujet->niveaux()->attach($request['niveaux']);
        }

        if ($request->has('matieres')) {
            $sujet->matieres()->detach();
            $sujet->matieres()->attach($request['matieres']);
        }

        return back()->with('success',  'Sujet modifié avec success');
    }


    //delete sujet
    public function destroy(string  $id)
    {
        //

        //  if($sujet->sujet_file){
        //     Storage::delete('public/' . $sujet->sujet_file);
        // }

        Sujet::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
