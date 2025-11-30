<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan folder covers lama agar tidak menumpuk
        Storage::disk('public')->deleteDirectory('covers');
        Storage::disk('public')->makeDirectory('covers');

        $categories = ['Teknologi', 'Sejarah', 'Fiksi', 'Sains', 'Bisnis'];
        
        // Data Buku Dummy
        $booksData = [
            ['Mastering Laravel 12', 'Taylor Otwell', 'Teknologi'],
            ['Sejarah Peradaban', 'Yuval Noah', 'Sejarah'],
            ['Atomic Habits', 'James Clear', 'Bisnis'],
            ['Dunia Sophie', 'Jostein Gaarder', 'Fiksi'],
            ['Kosmos', 'Carl Sagan', 'Sains'],
            ['Clean Code', 'Robert C. Martin', 'Teknologi'],
            ['Filosofi Teras', 'Henry Manampiring', 'Bisnis'],
            ['Bumi Manusia', 'Pramoedya A. Toer', 'Fiksi'],
        ];

        foreach ($booksData as $index => $data) {
            $title = $data[0];
            $author = $data[1];
            $category = $data[2];
            
            // 2. LOGIKA DOWNLOAD GAMBAR DUMMY
            // Kita gunakan layanan placehold.co untuk generate gambar
            // Format URL: https://placehold.co/{width}x{height}/png?text={text}
            $encodedTitle = urlencode($title);
            $imageUrl = "https://placehold.co/400x600/3b82f6/ffffff/png?text={$encodedTitle}";
            
            try {
                $imageContents = file_get_contents($imageUrl);
                $imageName = 'covers/book_' . ($index + 1) . '.png';
                
                // Simpan ke storage local
                Storage::disk('public')->put($imageName, $imageContents);
            } catch (\Exception $e) {
                $imageName = null; // Jika gagal download (misal offline), biarkan null
            }

            // 3. Simpan ke Database
            Book::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . Str::random(5),
                'author' => $author,
                'publisher' => 'Pustaka Indonesia',
                'publication_year' => rand(2018, 2024),
                'category' => $category,
                'description' => "Buku {$title} adalah buku best-seller di kategori {$category}. Sangat direkomendasikan untuk mahasiswa dan umum.",
                'stock' => rand(5, 15),
                'max_loan_days' => 7,
                'fine_per_day' => 1000,
                'cover_image' => $imageName, // Path gambar yang baru didownload
            ]);
        }
    }
}