<?php

namespace App\Http\Controllers\frontend;

use Exception;
use App\Models\News;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsFrontController extends Controller
{
    //get all news for category news
    public function news(){
        $slug = request('n');
        $categoryNews = CategoryNews::whereSlug($slug)->first();
        $id = $categoryNews['id'];

        $news = News::with(['user', 'categoryNews'])
        ->when($slug, function($q) use ($id) {
            return $q->where('category_news_id', $id);
        })->get();
        
        return view('front.pages.blog.news', compact('news', 'categoryNews'));
    }


    public function detail( Request $request){
        try {
            $slug = request('d');
            $news_detail = News::with(['user', 'categoryNews'])
                ->whereSlug($slug)->first();

            return view('front.pages.blog.detail',  compact('news_detail'));
        } catch (\Exception $e) {

            return $e->getMessage();
        }
      

       
    }

}
