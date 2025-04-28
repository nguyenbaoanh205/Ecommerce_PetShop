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
        $categories = [
            ['name' => 'Đồ ăn', 'description' => 'Thức ăn cho chó mèo'],
            ['name' => 'Đồ chơi', 'description' => 'Đồ chơi thú cưng'],
            ['name' => 'Quần áo', 'description' => 'Trang phục dễ thương cho thú cưng'],
        ];
    
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
