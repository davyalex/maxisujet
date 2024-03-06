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

        //supprimer tous les utilisateurs ou is_email_verified=0 et created_at  depasse 24H
        $now = Carbon::now()->addDay(7)->format('Y-m-d H:i:s'); //ajout de 1 jour
        // dd($now);
        //    User::where('is_email_verified', 0)->where(function ($query) use($now){
        //         //    $query->whereNull('email_verified_at')
        //         $query->where('created_at','<',$now);
        //    })->delete();
        // User::where('created_at', '<', now()->addDay(7))
        // ->where('is_email_verified', 0)
        // ->delete();


        // $admin = User::whereHas('roles', fn($q)=>$q->where('name', 'administrateur'))->get();
        // $admin_email = [];
        //     foreach ($admin as $value) {
        //         $email = $value['email'];
        //         array_push($admin_email, $email);
        //     }


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
