<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryID = DB::table('categories')->pluck('id') -> toArray();
        $proseed = [];
        for ($i=0; $i < 10; $i++) {
            $proseed[] = [
                'name' => fake()->name(),
                'description' => fake()->text(),
                'price' => fake()->randomFloat(2, 0, 100),
                'discount_price' => fake()->randomFloat(2, 0, 100),
                'quantity' => fake()->randomNumber(1,10),
                'category_id' => fake() -> randomElement($categoryID),
                'image' => 'images/default-image.jpg',
            ];
        }
        Product::insert($proseed);
    }
}
