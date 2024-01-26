<?php

namespace App\Http\Controllers\backend;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    //index __Liste category
    public function index()
    {
        $categories = Categorie::orderBy('title', 'ASC')->get();
        return view('admin.pages.categorie.index', compact('categories'));
    }

    //store category
    public function store(Request $request)
    {
       
        //validation
        $data =  $request->validate([
            'title' => 'required',
        ]);

        $category = Categorie::firstOrCreate([
            'title' => $request['title'],
        ]);

        return back()->with('success', 'Nouvelle categorie ajoutée avec success');
    }


    //update category
    public function update(Request $request, string $id)
    {

        $data =  $request->validate([
            'title' => 'required',
        ]);


        Categorie::whereId($id)->update([
            'title' => $request['title'],
        ]);

        return back()->withSuccess('Categorie modifiée avec success');
    }


    //delete category
    public function destroy(string $id)
    {
        //
        Categorie::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
