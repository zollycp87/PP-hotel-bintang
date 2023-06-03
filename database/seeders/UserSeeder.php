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
            'id_user' => 'A1',
            'username' => 'Super Admin',
            'nama' => 'Admin 1',
            'password' => bcrypt('admin1234'),
            'email' => 'admin@gmail.com',
            'role' => 'Admin'
        ]);
    }
}
