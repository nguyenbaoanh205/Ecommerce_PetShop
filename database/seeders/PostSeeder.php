<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryID = DB::table('categories')->pluck('id') -> toArray();
        $postSeed = [];
        for ($i=0; $i < 10; $i++) {
            $postSeed[] = [
                'category_id' => fake() -> randomElement($categoryID),
                'title' => fake()->name(),
                'content' => fake()->text(),
                'slug' => fake()->slug(),
                'description' => fake()->text(),
                'status' => fake()->randomElement([0,1]),
                'image' => 'uploads/images/default-image.jpg',
            ];
        }
        DB::table('posts')->insert($postSeed);
    }
}
