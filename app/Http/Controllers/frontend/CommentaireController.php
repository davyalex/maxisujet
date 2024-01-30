<?php

namespace App\Http\Controllers\frontend;

use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentaireController extends Controller
{
    //
    public function store(Request $request){
        $data = Commentaire::create([
            'content'=>$request['content'],
            'user_id' => auth()->user()->id,
            'news_id'=>$request['newsId'],
            'sujet_id'=>$request['sujetId'],
            'model'=>$request['model'],           
        ]);


        return response()->json([
            'message'=>'data found',
            'data'=>$data
        ],200);
    
    }
}
