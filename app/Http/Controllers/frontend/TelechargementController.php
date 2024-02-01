<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Sujet;
use Illuminate\Http\Request;
use App\Models\Telechargement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TelechargementController extends Controller
{
    //
    public function download(Request $request)
    {

        $sujet_id = $request['sujetId'];
        $file = $request['file'];
        $user_point = Auth::user()->point;
        $user_id = Auth::user()->id;

        if ($user_point == 0) {
            return response()->json([
                "success" => false,
                "message" => "Vous avez atteint la limite de telechargement",
            ], 200);

        } elseif ($user_point > 0) {
            Telechargement::create([
                'sujet_id' => $sujet_id,
                'user_id' => $user_id,
            ]);

                //on retire des point au user apres un telechargement
            $user = User::find($user_id)->decrement('point', 10);

            return Storage::download('public/' . $file);
            // $file_path = Storage::path('public/'.$file);
            // return response()->download($file_path);

            // return response()->json([
            //     "success" => true,
            //     "user_point" => Auth::user()->point,
            //     "message" => "Le fichier a été téléchargé avec succès",
            // ], 200);
           
        }




        
    }
}
