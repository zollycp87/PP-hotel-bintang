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
            'username' => 'superadmin',
            'nama' => 'Super Admin',
            'password' => bcrypt('admin1234'),
            'email' => 'superadmin@gmail.com',
            'role' => 'Super Admin'
            
        ]);
    }
}
