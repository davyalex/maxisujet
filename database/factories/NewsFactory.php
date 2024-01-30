<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\CategoryNews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id');
        $categoryNews = CategoryNews::pluck('id');


        return [
            //
            'title'=>$this->faker->sentence(10),
            'slug' => Str::slug($this->faker->sentence(10)),
            'content'=>$this->faker->paragraph(30),
            'user_id'=>$this->faker->randomElement($users),
            'category_news_id'=>$this->faker->randomElement($categoryNews),
             'image' =>$this->faker->image(storage_path('app/public/news'), 500, 500, null, false),
            'created_at'=>now(),
            'updated_at'=>now()



        ];
    }
}
