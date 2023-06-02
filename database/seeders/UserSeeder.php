<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id_user' => '1111000',
            'username' => 'Admin1',
            'nama' => 'Admin1',
            'password' => bcrypt('password'),
            'email' => 'admin1@gmail.com',
            'role' => 'Admin'
        ]);
        // User::truncate();
    }
}
