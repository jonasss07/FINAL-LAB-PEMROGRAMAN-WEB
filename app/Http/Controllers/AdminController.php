<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // 1. Halaman Dashboard Admin
    public function index()
    {
        // Mengambil data statistik untuk dashboard
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'student')->count();
        $activeLoans = Loan::where('status', 'borrowed')->count();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'activeLoans'));
    }

    // 2. Halaman Daftar Buku
    public function books()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    // 3. Halaman Tambah Buku
    public function bookCreate()
    {
        return view('admin.books.create');
    }

    // 4. Proses Simpan Buku ke Database
    public function bookStore(Request $request)
    {
        // Validasi Input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Gambar (Jika ada)
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // Simpan Data
        Book::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'category' => $request->category,
            'stock' => $request->stock,
            'max_loan_days' => 7, // Default
            'fine_per_day' => 1000, // Default  
            'cover_image' => $imagePath,
        ]);

        return redirect()->route('admin.books')->with('success', 'Buku berhasil ditambahkan!');
    }
}