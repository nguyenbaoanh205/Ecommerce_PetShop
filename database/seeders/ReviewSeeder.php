<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
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
            'Sản phẩm đúng mô tả, sẽ giới thiệu bạn bè.',
            'Thú cưng nhà mình rất thích sản phẩm này.',
            'Màu sắc đẹp, đúng như hình.',
            'Đóng gói chắc chắn, giao hàng nhanh.',
            'Hài lòng về chất lượng dịch vụ.',
        ];

        // Fake 10 reviews
        for ($i = 0; $i < 10; $i++) {
            Review::create([
                'user_id'    => $users->random()->id,
                'product_id' => $products->random()->id,
                'rating'     => rand(3, 5), // Xếp hạng từ 3 đến 5 sao
                'comment'    => fake()->randomElement($sampleComments),
            ]);
        }
    }
}
