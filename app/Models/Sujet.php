<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sujet extends Model
{
    use HasFactory;
    protected $fillable = [
        'sujet_title',
        'category_id',
        'user_id',
        'etablissement_id',
        'annee',
        'sujet_file',
        'corrige_file',
        'description',
        'created_at',
        'updated_at',
        'deleted_at'
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function niveaux():BelongsToMany {
            return $this->belongsToMany(Niveau::class)->withTimestamps();
        }

        public function matieres():BelongsToMany {
            return $this->belongsToMany(Matiere::class)->withTimestamps();
        }

        public function categorie()
        {
            return $this->belongsTo(Categorie::class, 'category_id');
        }

        public function etablissement()
        {
            return $this->belongsTo(Etablissement::class, 'etablissement_id');
        }

        public function commentaires(){
            return $this->hasMany(Commentaire::class);
        }

    public function user_download(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'telechargements_table', 'sujet_id', 'user_id')->withTimestamps();
    }


}
