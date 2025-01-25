<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SujetNews extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'code',
        'annee',
        'categorie',
        'niveau',
        'matiere',
        'etablissement',
        'sujet_file',
        'corrige_file',
        'approved',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user_download(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'telechargements', 'sujet_id', 'user_id')->withTimestamps();
    }


    public function downloading()
    {
        return $this->hasMany(Telechargement::class);
    }
}
