<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Sujet;
use App\Models\Niveau;
use App\Models\Matiere;
use App\Models\Categorie;
use App\Models\CategoryNews;
use App\Models\Etablissement;
use Spatie\Permission\Models\Role;
use App\Models\CategoryInformation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        Paginator::useBootstrap();

//supprimer tous les utilisateur qui n'ont pas confirmé leur inscription dans un delai de 15 min
        $admin = User::where('is_email_verified', 0)->get();

        $now = Carbon::now();

        foreach ($admin as $value) {
            $email = $value['email'];
            $date = $value['created_at'];
            $minute = $now->diffInMinutes($date);

            if ($minute == 15) {
               $value->delete();
            }
        }
        // dd($admin_email);


        /***************************************************************************************************** */






        //categories 
        $categories = Categorie::with('sujets')
            ->orderBy('title', 'ASC')->get();

        $categorie_news = CategoryNews::with('news')
            ->orderBy('title', 'ASC')->get();



        //niveaux
        $niveaux = Niveau::with('parent')->orderBy('parent_id', 'DESC')
            ->get();
        //etablissement
        $etablissements = Etablissement::orderBy('title', 'ASC')->get();


        //niveaux avec les sous niveaux
        $niveaux_with_subNiveaux = Niveau::where('parent_id', null)->orderBy('parent_id', 'DESC')
            ->with('subNiveaux', fn ($q) => $q->with('subNiveaux'))
            ->get();


        // dd($niveaux_with_subNiveaux->toArray());


        //matieres
        $matieres = Matiere::orderBy('title', 'ASC')->get();


        //sujets
        // $sujets = Sujet::with(['niveaux', 'matieres','categorie','etablissement'])->get();


        //roles 
        $roles = Role::get();



        view()->composer('*', function ($view) use ($categorie_news, $roles, $categories, $niveaux, $matieres, $niveaux_with_subNiveaux, $etablissements) {
            $view->with([
                'categories' => $categories,
                'categorie_news' => $categorie_news,
                'niveaux' => $niveaux,
                'matieres' => $matieres,
                'niveaux_with_subNiveaux' => $niveaux_with_subNiveaux,
                'etablissements' => $etablissements,
                // 'sujets' => $sujets,
                'roles' => $roles


            ]);
        });
    }
}
