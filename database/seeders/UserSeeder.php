<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Ruang Admin Lt. 1',
        ]);

        // 2. Akun Pegawai (Staff)
        User::create([
            'name' => 'Petugas Perpus',
            'email' => 'staff@library.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'phone' => '089876543210',
            'address' => 'Meja Sirkulasi',
        ]);

        // 3. Akun Mahasiswa (Untuk Test Login)
        User::create([
            'name' => 'Mahasiswa Demo',
            'email' => 'student@univ.ac.id',
            'password' => Hash::make('password'),
            'role' => 'student',
            'phone' => '081122334455',
            'address' => 'Jl. Kampus Merdeka No. 10',
        ]);

        // 4. Generate 10 Mahasiswa Random
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Mahasiswa ' . $i,
                'email' => "student{$i}@univ.ac.id",
                'password' => Hash::make('password'),
                'role' => 'student',
                'phone' => '0812000000' . $i,
                'address' => 'Asrama Mahasiswa Blok ' . chr(64 + $i),
            ]);
        }
    }
}