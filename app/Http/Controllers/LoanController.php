<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    // PROSES PINJAM BUKU
    public function store(Book $book)
    {
        $user = Auth::user();

        // 1. VALIDASI: Cek Denda Tertunggak
        if ($user->hasUnpaidFines()) {
            return back()->with('error', 'Anda memiliki denda tertunggak. Harap lunasi denda sebelum meminjam buku baru.');
        }

        // 2. VALIDASI: Cek Stok Buku
        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis.');
        }

        // 3. VALIDASI: Cek apakah sedang meminjam buku yang sama
        $existingLoan = Loan::where('user_id', $user->id)
                            ->where('book_id', $book->id)
                            ->where('status', 'borrowed')
                            ->exists();

        if ($existingLoan) {
            return back()->with('error', 'Anda sedang meminjam buku ini. Harap kembalikan terlebih dahulu.');
        }

        // 4. PROSES SIMPAN
        try {
            DB::transaction(function () use ($user, $book) {
                Loan::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'loan_date' => now(),
                    'due_date' => now()->addDays($book->max_loan_days), // Otomatis hitung tgl kembali
                    'status' => 'borrowed',
                ]);

                // B. Kurangi Stok Buku
                $book->decrement('stock');
            });

            return redirect()->route('student.loans')->with('success', 'Berhasil meminjam buku! Harap kembalikan tepat waktu.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    // HALAMAN HISTORY PEMINJAMAN
    public function index()
    {
        $loans = Loan::with('book')
                     ->where('user_id', Auth::id())
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
                     
        return view('student.loans.index', compact('loans'));
    }
}