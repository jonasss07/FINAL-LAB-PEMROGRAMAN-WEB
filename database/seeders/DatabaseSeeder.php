<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,   // User harus duluan
            BookSeeder::class,   // Buku harus duluan
            LoanSeeder::class,   // Loan butuh User & Book
            ReviewSeeder::class, // Review butuh Loan yang returned
        ]);
    }
}