<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cateSeed = [];
        for ($i=0; $i < 4; $i++) { 
            $cateSeed[] = [
                'name' => fake()->name(),
                'description' => fake()->text(),
                'type' => fake()->randomElement([1,2]),
                'status' => fake()->randomElement([0,1]),
            ];
        }
        Category::insert($cateSeed);

    }
}
