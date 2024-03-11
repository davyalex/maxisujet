<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Sujet;
use App\Models\Categorie;
use App\Mail\NewSujetEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SujetController extends Controller
{
    //index
    public function index()
    {
        $sujets = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($sujets->toArray());
        return view('admin.pages.sujet.index', compact('sujets'));
    }


    public function store(Request $request)
    {
        // dd($request->toArray());

        $uuid1 = Str::uuid()->toString();
        $uuid2 = Str::uuid()->toString();


        if ($request->hasFile('sujet_file')) {
            $fileNameSujet =  $uuid1 . '.' . $request->sujet_file->extension();
            $request->sujet_file->storeAs('public/', $fileNameSujet);
        }

        if ($request->hasFile('corrige_file')) {
            $fileNameCorrige =  $uuid2 . '.' . $request->corrige_file->extension();
            $request->corrige_file->storeAs('public/', $fileNameCorrige);
        } else {
            $fileNameCorrige = '';
        }

        //get category name from category_id
        $category_name = Categorie::whereId($request['category_id'])->first();
        $category_name =  $category_name->title;

        $sujet = Sujet::firstOrCreate([
            'sujet_title' =>  $category_name . mt_rand(),
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'annee' => $request['annee'],
            'etablissement_id' => $request['etablissement_id'],
            'sujet_file' => $fileNameSujet,
            'corrige_file' => $fileNameCorrige,
            'user_id' => Auth::user()->id,
        ]);


        //insert data in pivot table
        if ($request->has('niveaux')) {

            $sujet->niveaux()->attach($request['niveaux']);
        }

        if ($request->has('matieres')) {

            $sujet->matieres()->attach($request['matieres']);
        }


        //send email to all user admin
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'administrateur'))->get();

        foreach ($admin as $user) {
            Mail::to($user->email)->send(new NewSujetEmail($user));
        }

        return back()->with('success', 'Nouveau sujet crée avec success');
    }


    //edit
    public function edit(Request $request, $id)
    {
        $sujet = Sujet::with(['niveaux', 'matieres', 'categorie', 'etablissement', 'user'])
            ->whereId($id)
            ->first();
        // dd($sujet->toArray());
        return view('admin.pages.sujet.edit', compact('sujet'));
    }




    //update sujet

    public function update(Request $request, string $id)
    {

        $uuid1 = Str::uuid()->toString();
        $uuid2 = Str::uuid()->toString();


        if ($request->hasFile('sujet_file')) {
            $fileNameSujet =  $uuid1 . '.' . $request->sujet_file->extension();
            $request->sujet_file->storeAs('public/', $fileNameSujet);
            if ($request['sujet_file_exist']) {
                Storage::delete('public/' . $request['sujet_file_exist']);
            }
        } else {
            $fileNameSujet = $request['sujet_file_exist'];
        }

        if ($request->hasFile('corrige_file')) {
            $fileNameCorrige =  $uuid2 . '.' . $request->corrige_file->extension();
            $request->corrige_file->storeAs('public/', $fileNameCorrige);
            if ($request['corrige_file_exist']) {
                Storage::delete('public/' . $request['corrige_file_exist']);
            }
        } else {
            $fileNameCorrige = $request['corrige_file_exist'];
        }

        // dd($fileNameSujet,$fileNameCorrige);


        $sujet = tap(Sujet::find($id))->update([
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'annee' => $request['annee'],
            'etablissement_id' => $request['etablissement_id'],
            'sujet_file' => $fileNameSujet,
            'corrige_file' => $fileNameCorrige,
            'user_id' => Auth::user()->id,

        ]);

        //update pivot table
        if ($request->has('niveaux')) {
            $sujet->niveaux()->detach();
            $sujet->niveaux()->attach($request['niveaux']);
        }

        if ($request->has('matieres')) {
            $sujet->matieres()->detach();
            $sujet->matieres()->attach($request['matieres']);
        }

        return back()->with('success',  'Sujet modifié avec success');
    }


    //delete sujet
    public function destroy(string  $id)
    {
        //

        //  if($sujet->sujet_file){
        //     Storage::delete('public/' . $sujet->sujet_file);
        // }

        Sujet::whereId($id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }


    //approved sujet
    public function approved($id)
    {

        //change state approuved to 1

        Sujet::find($id)->update([
            'approved' => 1
        ]);

        //send mail after approuved sujet
        $sujet = Sujet::whereId($id)
            ->with('user')->first();
        $user = $sujet->user;

        Mail::send('admin.pages.email.email_approved_sujet', ['user' =>$user, 'sujet' => $sujet], function ($message) use ($user) {
            $message->to($user['email']);
            $message->subject('Votre sujet à été approuvé !');
        });
        
       


        return back()->with('success', 'Le sujet a été validé !');
    }
}
