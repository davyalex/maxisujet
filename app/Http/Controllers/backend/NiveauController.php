<?php

namespace App\Http\Controllers\backend;

use App\Models\Niveau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NiveauController extends Controller
{
    //
    //index __Liste Niveau
    public function index(Request $request)
    {
        //liste de tous les niveaux
        $niveaux = Niveau::with('parent')->orderBy('title', 'ASC')->paginate(10);

        if ($request->ajax()) {
            // Formater les données pour inclure les actions
            $data = $niveaux->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'parent' => $item->parent ? $item->parent->title : 'N/A',  // Titre du parent ou "N/A"
                    'created_at' => $item->created_at->format('d-m-Y'),
                    'action' => view('admin.pages.niveau.actions', compact('item'))->render(),  // Vue pour les actions
                ];
            });

            return response()->json([
                'data' => $data,
                'recordsTotal' => $niveaux->total(),
                'recordsFiltered' => $niveaux->total(),
                'draw' => $request->get('draw'),
            ]);
        }
        //liste des niveaux uniquement parent
        $niveaux_parent = Niveau::where('parent_id', null)->orderBy('title', 'ASC')->get();

        // dd($niveaux->toArray());
        return view('admin.pages.niveau.index', compact('niveaux', 'niveaux_parent'));
    }

    //store Niveau
    public function store(Request $request)
    {
        //validation
        $data =  $request->validate([
            'title' => 'required',
        ]);

        $Niveau = Niveau::firstOrCreate([
            'title' => $request['title'],
            'parent_id' => $request['parent_id'],

        ]);

        return back()->with('success', 'Nouveau Niveau ajouté avec success');
    }


    //update Niveau
    public function update(Request $request, string $id)
    {

        $data =  $request->validate([
            'title' => 'required',
        ]);


        Niveau::whereId($id)->update([
            'title' => $request['title'],
            'parent_id' => $request['parent_id'],
        ]);

        return back()->withSuccess('Niveau modifié avec success');
    }


    //delete Niveau
    public function destroy(string $id)
    {
        //
        Niveau::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }
}
