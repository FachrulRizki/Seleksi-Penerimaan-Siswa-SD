<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Admin::create([
            'nama' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('admin123')
        ]);
    }
}
