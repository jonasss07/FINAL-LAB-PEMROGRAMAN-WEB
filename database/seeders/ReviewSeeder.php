<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Loan;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Cari semua peminjaman yang sudah dikembalikan
        $returnedLoans = Loan::where('status', 'returned')->get();

        foreach ($returnedLoans as $loan) {
            Review::create([
                'user_id' => $loan->user_id,
                'book_id' => $loan->book_id,
                'rating' => rand(3, 5), // Rating random 3-5
                'comment' => 'Buku ini sangat bagus dan bermanfaat untuk referensi kuliah.',
            ]);
        }
    }
}