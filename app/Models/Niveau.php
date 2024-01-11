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
        'created_at',
        'updated_at',
        'deleted_at'
        ];
}
