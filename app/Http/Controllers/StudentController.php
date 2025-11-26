<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

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
    public function show(Book $book) // Route Model Binding
    {
        return view('student.books.show', compact('book'));
    }
}
