<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->tinyInteger('type')->unsigned()->default(1)->comment('1: Danh mục sản phẩm, 2: Danh mục bài viết'); // Thêm cột type với giá trị 1 hoặc 2
            $table->tinyInteger('status')->unsigned()->default(1)->comment('0: Inactive, 1: Active'); // Thêm cột status với giá trị 0 hoặc 1
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['type', 'status']); // Xóa cột type và status khi rollback
        });
    }
};
