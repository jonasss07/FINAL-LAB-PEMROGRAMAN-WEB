<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku (READ).
     */
    public function index()
    {
        // Mengambil data terbaru dengan pagination
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    /**
     * Menampilkan form tambah buku (CREATE - Form).
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Menyimpan buku baru ke database (CREATE - Action).
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1900|max:'.(date('Y')+1),
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'max_loan_days' => 'required|integer|min:1',
            'fine_per_day' => 'required|numeric|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 2. Handle Upload Gambar
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // 3. Simpan Data
        Book::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5),
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'category' => $request->category,
            'description' => $request->description, // Opsional
            'stock' => $request->stock,
            'max_loan_days' => $request->max_loan_days,
            'fine_per_day' => $request->fine_per_day,
            'cover_image' => $imagePath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit buku (UPDATE - Form).
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Memperbarui data buku (UPDATE - Action).
     */
    public function update(Request $request, Book $book)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer',
            'category' => 'required|string',
            'stock' => 'required|integer|min:0',
            'max_loan_days' => 'required|integer',
            'fine_per_day' => 'required|numeric',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Handle Gambar (Jika ada upload baru)
        $imagePath = $book->cover_image; // Default pakai gambar lama
        
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika ada
            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            // Upload gambar baru
            $imagePath = $request->file('cover_image')->store('covers', 'public');
        }

        // 3. Update Data
        $book->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(5), // Update slug jika judul berubah
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publication_year' => $request->publication_year,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'max_loan_days' => $request->max_loan_days,
            'fine_per_day' => $request->fine_per_day,
            'cover_image' => $imagePath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku (DELETE).
     */
    public function destroy(Book $book)
    {
        // 1. Hapus gambar fisik dari storage
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        // 2. Hapus data dari database
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}