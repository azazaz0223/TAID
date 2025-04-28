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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('大標');
            $table->text('subtitle')->comment('小標');
            $table->string('image')->nullable();
            $table->string('content_image')->nullable()->comment('內文圖片');
            $table->text('content_text')->comment('內文文字');
            $table->boolean('status')->default(0)->comment('狀態');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
