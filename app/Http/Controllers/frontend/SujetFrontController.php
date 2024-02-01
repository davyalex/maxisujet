<?php

namespace App\Http\Controllers\frontend;

use App\Models\Sujet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SujetFrontController extends Controller
{
    //
    public function allSujet()
    {
        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'commentaires'])
            ->when(request('category'), function ($q) {
                return $q->where('category_id', request('category'));
            })

            ->when(request('niveau'), function ($q) {
                return $q->whereHas('niveaux', function ($q) {
                    $q->where('niveau_sujet.niveau_id', request('niveau'));
                });
            })

            ->get();



        return view('front.pages.sujet', compact("sujets"));
    }


    public function search(Request $request)
    {

        // dd($request->niveaux);

        $category = $request['categorie'];
        $code_sujet = $request['code_sujet'];
        $niveaux = $request['niveaux'];
        $matieres = $request['matieres'];
        // $search = $request['q'];

        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'commentaires'])
            ->when($category, function ($q) use ($category) {
                return $q->where('category_id', $category);
            })

            ->when($code_sujet, function ($q) use ($code_sujet) {
                return $q->where('sujet_title', $code_sujet);
            })


            ->when($niveaux, function ($q) use ($niveaux) {
                return $q->whereHas('niveaux', function ($q) use ($niveaux) {
                    $q->where('niveau_sujet.niveau_id', $niveaux);
                });
            })

            ->when($matieres, function ($q) use ($matieres) {
                return $q->whereHas('matieres', function ($q) use ($matieres) {
                    $q->where('matiere_sujet.matiere_id', $matieres);
                });
            })->get();

        return view('front.pages.sujet', compact('sujets'));

    }
}
