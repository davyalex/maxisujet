<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telechargement extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'sujet_id',
        'created_at',
        'updated_at'
    ];
}
