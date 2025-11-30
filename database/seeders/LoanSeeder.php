<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data user mahasiswa dan buku
        $students = User::where('role', 'student')->get();
        $books = Book::all();

        if ($students->count() == 0 || $books->count() == 0) {
            return; // Stop jika tidak ada data
        }

        // SKENARIO 1: Peminjaman Aktif (Belum Kembali, Belum Telat)
        Loan::create([
            'user_id' => $students->first()->id, // Mahasiswa Demo
            'book_id' => $books[0]->id,
            'loan_date' => Carbon::now()->subDays(2), // Pinjam 2 hari lalu
            'due_date' => Carbon::now()->addDays(5),  // Kembali 5 hari lagi
            'status' => 'borrowed',
        ]);

        // SKENARIO 2: Peminjaman Terlambat (Overdue)
        // Ini untuk ngetes fitur denda di staff
        Loan::create([
            'user_id' => $students->get(1)->id, // Mahasiswa random 1
            'book_id' => $books[1]->id,
            'loan_date' => Carbon::now()->subDays(10), // Pinjam 10 hari lalu
            'due_date' => Carbon::now()->subDays(3),   // Jatuh tempo 3 hari lalu (Telat!)
            'status' => 'borrowed',
        ]);

        // SKENARIO 3: Sudah Dikembalikan (Riwayat)
        Loan::create([
            'user_id' => $students->first()->id,
            'book_id' => $books[2]->id,
            'loan_date' => Carbon::now()->subDays(20),
            'due_date' => Carbon::now()->subDays(13),
            'return_date' => Carbon::now()->subDays(15), // Kembali tepat waktu
            'status' => 'returned',
            'fine_amount' => 0,
            'is_fine_paid' => true,
        ]);
        
        // SKENARIO 4: Sudah Kembali tapi Pernah Kena Denda (Lunas)
        Loan::create([
            'user_id' => $students->first()->id,
            'book_id' => $books[3]->id,
            'loan_date' => Carbon::now()->subDays(30),
            'due_date' => Carbon::now()->subDays(23),
            'return_date' => Carbon::now()->subDays(20), // Telat 3 hari
            'status' => 'returned',
            'fine_amount' => 3000,
            'is_fine_paid' => true, // Sudah bayar
        ]);
    }
}