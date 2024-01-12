<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

        
}
