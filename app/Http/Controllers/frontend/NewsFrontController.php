<?php

namespace App\Http\Controllers\frontend;

use Exception;
use App\Models\News;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\RouteAction;

class NewsFrontController extends Controller
{
    //get all news for category news
    public function news(){

        try {
            $slug = request('n');
            $categoryNews = CategoryNews::whereSlug($slug)->first();
            $id = $categoryNews['id'];

            $news = News::with(['user', 'categoryNews'])
                ->when($slug, function ($q) use ($id) {
                    return $q->where('category_news_id', $id);
                })->get();


            return view('front.pages.blog.news', compact('news', 'categoryNews'));
        } catch (\Exception $e) {
            return redirect()->action([HomeController::class, 'home']);
        }
      
    }


    public function detail( Request $request){
        try {
            $slug = request('d');
            $news_detail = News::with(['user', 'categoryNews'])
                ->whereSlug($slug)->first();

                if (!$news_detail) {
                return redirect()->action([HomeController::class, 'home']);
                }
    
            return view('front.pages.blog.detail',  compact('news_detail'));
        } catch (\Exception $e) {

        }
      

       
    }

}
