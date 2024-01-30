<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentaire extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content', // contenu
        'model', // table ex: Sujet, News...
        'user_id',
        'sujet_id',
        'news_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }



}
