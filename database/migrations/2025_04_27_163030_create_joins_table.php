<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('joins', function (Blueprint $table) {
            $table->id();
            $table->string('zh_title')->comment('中文標題');
            $table->string('en_title')->comment('英文標題');
            $table->text('content')->comment('內文描述');
            $table->string('image1')->comment('圖片一');
            $table->string('image2')->comment('圖片二');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joins');
    }
};
