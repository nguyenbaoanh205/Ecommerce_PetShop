<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();       // Tiêu đề banner
            $table->string('image');                   // Đường dẫn ảnh banner
            $table->string('link')->nullable();        // Link khi click vào banner
            $table->tinyInteger('status')->default(1);  // Mặc định là 1 hiển thị 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
