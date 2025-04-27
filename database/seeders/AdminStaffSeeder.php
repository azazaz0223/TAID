<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Staff::truncate();
        Staff::create([
            'name' => 'admin',
            'account' => 'admin',
            'password' => Hash::make('1111'),
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
