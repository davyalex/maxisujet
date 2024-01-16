<?php

namespace App\Providers;

use App\Models\Sujet;
use App\Models\Niveau;
use App\Models\Matiere;
use App\Models\Categorie;
use App\Models\Etablissement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //categories 
        $categories = Categorie::orderBy('title', 'ASC')->get();

        //niveaux
        $niveaux = Niveau::with('parent')->orderBy('parent_id', 'DESC')
            ->get();
        //etablissement
        $etablissements = Etablissement::orderBy('title', 'ASC')->get();


        //niveaux avec les sous niveaux
        $niveaux_with_subNiveaux = Niveau::where('parent_id', null)->orderBy('parent_id', 'DESC')
            ->with('subNiveaux')
            ->get();


        // dd($niveaux_with_subNiveaux->toArray());


        //matieres
        $matieres = Matiere::orderBy('title', 'ASC')->get();

        $sujets = Sujet::with(['niveaux', 'matieres','categorie','etablissement'])->get();



        view()->composer('*', function ($view) use ($sujets,$categories, $niveaux, $matieres, $niveaux_with_subNiveaux, $etablissements) {
            $view->with([
                'categories' => $categories,
                'niveaux' => $niveaux,
                'matieres' => $matieres,
                'niveaux_with_subNiveaux' => $niveaux_with_subNiveaux,
                'etablissements' => $etablissements,
                'sujets' => $sujets

            ]);
        });
    }
}
