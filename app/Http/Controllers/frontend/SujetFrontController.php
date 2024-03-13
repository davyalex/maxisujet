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
    public function allSujet(Request $request)
    {
        //
        $category = $request['category'];
        $niveaux = $request['niveau'];
       
        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'commentaires'])
            ->when($category, function ($q)  use ($category) {
                return $q->where('category_id', $category);
            })
            ->when($niveaux, function ($q)  use ($niveaux) {
                return $q->whereHas('niveaux', function ($q)  use ($niveaux) {
                    $q->where('niveau_sujet.niveau_id', $niveaux);
                });
            })
            ->whereApproved(1)
            ->get();


        // 
        // Get title of request
        $matieres_req = '';
        $categorie_req = '';
        $code_req = '';
        $niveaux_req = '';
        $annee_req = '';



      




        return view('front.pages.sujet', compact(
            'sujets',
            'matieres_req',
            'categorie_req',
            'code_req',
            'niveaux_req',
            'annee_req',
        ));
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



        // Get title of request
        $matieres_req = '';
        $categorie_req = '';
        $code_req = '';
        $niveaux_req = '';
        $annee_req = '';



        if (!empty($category)) {
            $categorie = Categorie::findOrFail($category);
            $categorie_req = $categorie;
        } else {
            $categorie_req = '';
        }


        if (!empty($matieres)) {
            $matiere = Matiere::whereIn('id', $matieres)->get();
            $matieres_req = $matiere;
        } else {
            $matieres_req = '';
        }

        if (!empty($niveaux)) {
            $niveau = Niveau::whereIn('id', $niveaux)->get();
            $niveaux_req = $niveau;
        } else {
            $niveaux_req = '';
        }


        if (!empty($annee)) {

            $annee_req = $annee;
        } else {
            $annee_req = '';
        }

        if (!empty($code_sujet)) {
            $code_req = $code_sujet;
        } else {
            $code_req = '';
        }






        // dd([
        //     $matieres_req,
        //     $categorie_req,
        //     $niveaux_req,
        //     $code_req,
        //     $annee_req
        // ]);


        return view('front.pages.sujet', compact(
            'sujets',
            'matieres_req',
            'categorie_req',
            'code_req',
            'niveaux_req',
            'annee_req',
        ));
    }
}
