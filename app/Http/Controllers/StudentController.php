<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // 1. Halaman Dashboard / Katalog Buku
    public function index(Request $request)
    {
        // Query Dasar
        $query = Book::query();

        // Logika Pencarian (Search)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Logika Filter Kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Ambil data (Pagination 12 buku per halaman)
        $books = $query->latest()->paginate(12);

        // Ambil list kategori unik untuk dropdown filter
        $categories = Book::select('category')->distinct()->pluck('category');

        return view('student.dashboard', compact('books', 'categories'));
    }

    // 2. Halaman Detail Buku
    public function show(Book $book)
    {
        // Load ulasan beserta nama user yang mereview
        $book->load(['reviews.user']);

        // Cek apakah user yang login SUDAH PERNAH meminjam & mengembalikan buku ini (Syarat Review)
        $hasBorrowed = Loan::where('user_id', Auth::id())
                           ->where('book_id', $book->id)
                           ->where('status', 'returned')
                           ->exists();

        // Cek apakah user sudah pernah mereview buku ini (Agar tidak spam review berulang)
        $hasReviewed = Review::where('user_id', Auth::id())
                             ->where('book_id', $book->id)
                             ->exists();

        return view('student.books.show', compact('book', 'hasBorrowed', 'hasReviewed'));
    }

    // 3. Proses Simpan Review
    public function storeReview(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Validasi Manual: Pastikan user berhak mereview
        $hasBorrowed = Loan::where('user_id', Auth::id())
                           ->where('book_id', $book->id)
                           ->where('status', 'returned')
                           ->exists();

        if (!$hasBorrowed) {
            return back()->with('error', 'Anda hanya dapat mengulas buku yang sudah pernah dipinjam dan dikembalikan.');
        }

        // Simpan Review
        Review::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda telah diterbitkan.');
    }
}