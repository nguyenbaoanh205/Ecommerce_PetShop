<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all(); 

        $sampleComments = [
            'Sản phẩm rất tốt, thú cưng của tôi thích lắm!',
            'Chất lượng ổn, sẽ ủng hộ lần sau.',
            'Giao hàng nhanh, đóng gói cẩn thận.',
            'Không như mong đợi, sản phẩm hơi nhỏ.',
            'Giá hợp lý, shop tư vấn nhiệt tình.',
        ];

        foreach ($products as $product) {
            // Mỗi sản phẩm có từ 1 đến 5 đánh giá
            $randomUsers = $users->random(rand(1, 5));

            foreach ($randomUsers as $user) {
                Review::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'rating' => rand(3, 5), // Xếp hạng từ 3 đến 5 sao
                    'comment' => fake()->randomElement($sampleComments),
                ]);
            }
        }
    }
}
