<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Chuyển từ string sang enum
            $table->enum('status', [
                'pending',      // Chờ xác nhận
                'confirmed',    // Đã xác nhận / đang xử lý
                'shipped',      // Đã gửi hàng
                'completed',    // Hoàn tất
                'returned',     // Khách trả hàng
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
