<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia, Sluggable, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'image',
        'category_news_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];



    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categoryNews()
    {
        return $this->belongsTo(CategoryNews::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
