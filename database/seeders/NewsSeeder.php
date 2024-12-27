<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     protected $model = News::class;

    public function run(): void
    {
        //
        News::factory()->count(10)->create();
    }
}
