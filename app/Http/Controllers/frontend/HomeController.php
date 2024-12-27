<?php

namespace App\Http\Controllers\frontend;

use App\Models\News;
use App\Models\Sujet;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  //
  public function home()
  {
    //get news of actualite
    // $actualite = CategoryNews::whereSlug('maxi-actualites')->first();
    // $actualites = News::with(['categoryNews', 'user'])->where('category_news_id', $actualite['id'])->orderBy("created_at", "desc")->take(6)->get();


    $actualite = CategoryNews::whereSlug('maxi-actualites')->first();

    if ($actualite) {
      $actualites = News::with(['categoryNews', 'user'])
        ->where('category_news_id', $actualite->id) // Utilisez `->id` au lieu de `['id']`
        ->orderBy("created_at", "desc")
        ->take(6)
        ->get();
    } else {
      $actualites = collect(); // Une collection vide pour éviter une autre erreur
    }

    //get news of astuce et conseils
    // $astuce = CategoryNews::whereSlug('astuce-conseil')->first();
    // $astuces = News::with(['categoryNews', 'user'])->where('category_news_id', $astuce['id'])->orderBy("created_at", "desc")->take(6)->get();


    $astuce = CategoryNews::whereSlug('astuce-conseil')->first();

    $astuces = $astuce
      ? News::with(['categoryNews', 'user'])
      ->where('category_news_id', $astuce->id)
      ->orderBy("created_at", "desc")
      ->take(6)
      ->get()
      : collect(); // Retourne une collection vide si `$astuce` est null

    // dd($astuce);
    //get subject recent
    $sujet_recents = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement'])->take(6)
      ->whereApproved(1)
      ->get();


    //Liste des sujets les plus telechargés
    $top_downloads = Sujet::withCount('downloading')->get();

    // dd($top_downloads->toArray());

    return view('front.pages.home',  compact('sujet_recents', 'actualites', 'astuces', 'actualite', 'astuce'));
  }


  public function statistic() {}
}
