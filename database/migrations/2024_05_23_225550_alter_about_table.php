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
        Schema::table('about', function (Blueprint $table) {
            $table->string('image1_content_image')->nullable()->after('image1_content')->comment('圖片一內文圖片');
            $table->string('image2_content_image')->nullable()->after('image2_content')->comment('圖片二內文圖片');
            $table->string('image3_content_image')->nullable()->after('image3_content')->comment('圖片三內文圖片');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn('image3_content_image');
            $table->dropColumn('image2_content_image');
            $table->dropColumn('image1_content_image');
        });
    }
};
