<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Xương gặm cho chó',
            'description' => 'Giúp chó gặm sạch răng, không hôi miệng',
            'price' => 50000,
            'discount_price' => 45000,
            'quantity' => 100,
            'category_id' => 1,
            'image' => 'images/xuong-gam.jpg',
        ]);
    
        Product::create([
            'name' => 'Áo hoodie cho mèo',
            'description' => 'Hoodie bông ấm áp cho mèo con',
            'price' => 120000,
            'discount_price' => null,
            'quantity' => 50,
            'category_id' => 3,
            'image' => 'images/hoodie-meo.jpg',
        ]);
    }
}
