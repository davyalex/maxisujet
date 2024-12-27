<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Niveau extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'parent_id',
        'created_at',
        'updated_at',
        'deleted_at'
        ];

        public function parent(){
            return $this->belongsTo(Niveau::class,'parent_id');
        }


        public function subNiveaux(){
            return $this->hasMany(Niveau::class,'parent_id');
        }


        public function niveaux():BelongsToMany {
            return $this->belongsToMany(Niveau::class)->withTimestamps();
        }

        
}
