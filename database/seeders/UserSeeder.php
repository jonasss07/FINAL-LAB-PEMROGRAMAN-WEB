<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin
    User::create([
        'name' => 'Super Admin',
        'email' => 'admin@library.com',
        'password' => Hash::make('password'), // password default
        'role' => 'admin',
    ]);

    // 2. Akun Pegawai (Staff)
    User::create([
        'name' => 'Petugas Perpus',
        'email' => 'staff@library.com',
        'password' => Hash::make('password'),
        'role' => 'staff',
    ]);

    // 3. Akun Mahasiswa
    User::create([
        'name' => 'Mahasiswa Teladan',
        'email' => 'student@univ.ac.id', // Email valid univ
        'password' => Hash::make('password'),
        'role' => 'student',
        'address' => 'Jl. Kampus Merdeka No. 1',
    ]);
    }
}
