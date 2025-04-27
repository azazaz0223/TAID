<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        About::truncate();
        About::create([
            'zh_title' => '中文大標',
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
