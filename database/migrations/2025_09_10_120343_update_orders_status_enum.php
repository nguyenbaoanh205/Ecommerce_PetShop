<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', [
                'pending',      // Chờ xác nhận
                'confirmed',    // Đã xác nhận
                'processing',   // Đang xử lý / đóng gói
                'shipped',      // Đã bàn giao vận chuyển
                'delivered',    // Đã giao (chờ khách xác nhận)
                'completed',    // Hoàn tất (khách xác nhận)
                'failed',       // Giao thất bại
                'returned',     // Khách trả hàng
                'refunded',     // Đã hoàn tiền
                'cancelled'     // Đã hủy
            ])->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')->default('pending')->change();
        });
    }
};
