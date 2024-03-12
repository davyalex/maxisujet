<?php

namespace App\Http\Controllers\frontend;

use App\Models\Sujet;
use App\Models\Matiere;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Niveau;

class SujetFrontController extends Controller
{
    //
    public function allSujet()
    {
        //

        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'commentaires'])
            ->when(request('category'), function ($q) {
                return $q->where('category_id', request('category'));
            })
            ->when(request('niveau'), function ($q) {
                return $q->whereHas('niveaux', function ($q) {
                    $q->where('niveau_sujet.niveau_id', request('niveau'));
                });
            })
            ->whereApproved(1)
            ->get();



        return view('front.pages.sujet', compact('sujets'));
    }


    public function search(Request $request)
    {



        $category = $request['categorie'];
        $code_sujet = $request['code_sujet'];
        $niveaux = $request['niveaux'];
        $matieres = $request['matieres'];
        $annee = $request['annee'];


        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'commentaires'])
            ->when($category, function ($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->when($annee, function ($q) use ($annee) {
                return $q->where('annee', $annee);
            })

            ->when($code_sujet, function ($q) use ($code_sujet) {
                return $q->where('sujet_title', $code_sujet);
            })


            ->when($niveaux, function ($q) use ($niveaux) {
                return $q->whereHas('niveaux', function ($q) use ($niveaux) {
                    $q->whereIn('niveau_sujet.niveau_id', $niveaux);
                });
            })

            ->when($matieres, function ($q) use ($matieres) {
                return $q->whereHas('matieres', function ($q) use ($matieres) {
                    $q->whereIn('matiere_sujet.matiere_id', $matieres);
                });
            })
            ->whereApproved(1)
            ->get();


        // $titre = [];

        // if ($code_sujet || $annee || $matieres || $category || $niveaux) {
        //     $categorie = Categorie::findOrFail($category);

        //     $matiere = Matiere::whereIn('id', $matieres)->get();
        //     $niveau = Niveau::whereIn('id', $niveaux)->get();

        //     array_push($titre, ['categorie_title' => $categorie, 'matieres_title' => $matiere, 'niveaux_title' => $niveau, 'code_sujet_title' => $code_sujet, 'annee_title' => $annee]);
        // }else{
        //     array_push($titre, 'liste des sujets');
        // }



        //Get title of request
        // $titre = [];
        // if (!empty($code_sujet)) {
        //     array_push($titre, $annee);
        // } elseif (!empty($category)) {
        //     $categorie = Categorie::findOrFail($category);
        //     array_push($titre, $categorie);
        // } elseif (!empty($matieres)) {
        //     $matiere = Matiere::whereIn('id', $matieres)->get();
        //     array_push($titre, $matiere);
        // } elseif (!empty($niveaux)) {
        //     $niveau = Niveau::whereIeen('id', $niveaux)->get();
        //     array_push($titre, $niveau);
        // } elseif (!empty($annee)) {
        //     $annee = Sujet::where('annee', $annee)->get();
        //     array_push($titre, $annee);
        // }



        // dd([
        //     $sujets,
        //     $titre
        // ]);


        // dd($sujets->toArray());

        return view('front.pages.sujet', compact('sujets'));
    }
}
