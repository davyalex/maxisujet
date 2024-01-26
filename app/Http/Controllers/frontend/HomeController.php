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
        $actualite = CategoryNews::whereSlug('maxi-actualites')->first();
        $actualites = News::with(['categoryNews', 'user'])->where('category_news_id', $actualite['id'])->orderBy("created_at", "desc")->get();
        
          //get news of astuce et conseils
        $astuce = CategoryNews::whereSlug('astuce-conseil')->first();
        $astuces = News::with(['categoryNews', 'user'])->where('category_news_id', $astuce['id'])->orderBy("created_at", "desc")->get();

        // dd($astuce);
        //get subject recent
        $sujet_recents = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement'])->take(6)->get();
        
        return view('front.pages.home',  compact('sujet_recents', 'actualites' , 'astuces', 'actualite', 'astuce'));
    }
}
