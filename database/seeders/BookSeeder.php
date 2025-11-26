<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
        'title' => 'Belajar Laravel 12',
        'slug' => Str::slug('Belajar Laravel 12'),
        'author' => 'Taylor Otwell',
        'publisher' => 'Laravel Press',
        'publication_year' => 2024,
        'category' => 'Teknologi',
        'description' => 'Panduan lengkap framework PHP modern.',
        'stock' => 5,
        'max_loan_days' => 7,
        'fine_per_day' => 1000,
    ]);

    Book::create([
        'title' => 'Sejarah Dunia',
        'slug' => Str::slug('Sejarah Dunia'),
        'author' => 'Sejarawan X',
        'publisher' => 'History Books',
        'publication_year' => 2020,
        'category' => 'Sejarah',
        'stock' => 3,
    ]);
    }
}
