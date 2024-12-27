<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    //

    public function index()
    {
        try {
            $news = News::with(['user', 'categoryNews'])->get();
            return view('admin.pages.blog.news.index', compact('news'));
        } catch (Exception $e) {
            $e->getMessage();
        }
       
    }

    public function create()
    {

        return view('admin.pages.blog.news.create');
    }

    public function store(Request $request)
    {
        //validate the request
        if ($request->hasFile('image')) {
            $fileName = Str::random(10) . '.' . $request->image->extension();
            $request->image->storeAs('/public/news', $fileName);
        }

        $news = News::firstOrCreate([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $fileName,
            'category_news_id' => $request['category_news'],
            'user_id' => Auth::user()->id,
        ]);

        return back()->with('success', 'Le nouvel article ajouté avec success');
    }


    public function edit(Request $request,  $slug)
    {

        try {
            $news_edit = News::with(['user', 'categoryNews'])
                ->whereSlug($slug)
                ->first();

            return view('admin.pages.blog.news.edit', compact('news_edit'));
        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    public function update(Request $request , $id){

        if ($request->hasFile('image')) {
            Storage::delete('public/news' . $request['image_exist']);
            $fileName = Str::random(10) . '.' . $request->image->extension();
            $request->image->storeAs('/public/news', $fileName);  
        }else{
              $fileName = $request['image_exist'];
        }

        $news = tap(News::find($id))->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $fileName,
            'category_news_id' => $request['category_news'],
            'user_id' => Auth::user()->id,
        ]);

        return back()->with('success',  'News modifié avec success');

    }

    public function destroy(string  $id)
    {
        News::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
