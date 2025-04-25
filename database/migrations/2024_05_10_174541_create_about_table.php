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
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('zh_title')->comment('中文標題');
            $table->string('en_title')->comment('英文標題');
            $table->text('content')->comment('服務需求');
            $table->string('image1')->comment('圖片一');
            $table->string('image1_title')->comment('圖片一標題');
            $table->text('image1_content')->comment('圖片一內容');
            $table->string('image2')->comment('圖片二');
            $table->string('image2_title')->comment('圖片二標題');
            $table->text('image2_content')->comment('圖片按內容');
            $table->string('image3')->comment('圖片三');
            $table->string('image3_title')->comment('圖片三標題');
            $table->text('image3_content')->comment('圖片三內容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about');
    }
};
