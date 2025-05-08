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
        Schema::table('joins', function (Blueprint $table) {
            $table->text('image1_url')->after('image1')->comment('圖片一連結');
            $table->text('image2_url')->after('image2')->comment('圖片二連結');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('joins', function (Blueprint $table) {
            $table->dropColumn('image2_url');
            $table->dropColumn('image1_url');
        });
    }
};
