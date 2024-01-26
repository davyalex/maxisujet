<?php

namespace App\Http\Controllers\backend;

use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryNewsController extends Controller
{
    //
     //
     //index __Liste category
     public function index()
     {
         $categories_infos = CategoryNews::get();
        //  dd( $categories_infos);
         return view('admin.pages.blog.categorie.index');
     }
 
     //store category
     public function store(Request $request)
     {
        
         //validation
         $data =  $request->validate([
             'title' => 'required',
         ]);
 
         $category = CategoryNews::firstOrCreate([
             'title' => $request['title'],
             'description' => $request['description'],

         ]);
 
         return back()->with('success', 'Nouvelle categorie ajoutée avec success');
     }
 
 
     //update category
     public function update(Request $request, string $id)
     {
 
         $data =  $request->validate([
             'title' => 'required',
         ]);
 
 
         CategoryNews::whereId($id)->update([
             'title' => $request['title'],
             'description' => $request['description'],

         ]);
 
         return back()->withSuccess('Categorie modifiée avec success');
     }
 
 
     //delete category
     public function destroy(string $id)
     {
         //
         CategoryNews::whereId($id)->delete();
         return response()->json([
             'status' => 200
         ]);
     }
}
