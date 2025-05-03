<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sampleImages = [
            'uploads/banners/banner1.jpg',
            'uploads/banners/banner2.jpg',
            'uploads/banners/banner3.jpg',
        ];

        foreach ($sampleImages as $image) {
            Banner::create([
                'title' => fake()->sentence(3),
                'image' => $image,
                'link' => fake()->url(),
                'status' => rand(0, 1),
            ]);
        }
    }
}
