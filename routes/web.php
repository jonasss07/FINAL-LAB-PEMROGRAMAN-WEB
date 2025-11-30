<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;   // Controller Baru
use App\Http\Controllers\ReportController; // Controller Baru

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan (Landing Page)
Route::get('/', function () {
    // Mengambil 4 buku terbaru untuk ditampilkan di welcome page
    $featuredBooks = \App\Models\Book::latest()->take(4)->get();
    return view('welcome', compact('featuredBooks'));
});

// Redirect Dashboard Logic
Route::get('/dashboard', function () {
    if (!Auth::check()) return redirect('/login');
    
    $role = Auth::user()->role;
    return match($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// 1. GROUP ROUTE ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.') // Prefix nama route jadi 'admin.'
    ->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Manajemen Buku (Resource: index, create, store, edit, update, destroy)
        Route::resource('books', BookController::class);

        // Manajemen User (Baru)
        Route::resource('users', UserController::class);

        // Laporan Analitik (Baru)
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    });

// ==========================================
// 2. GROUP ROUTE STAFF (PEGAWAI)
// ==========================================
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {
        
        // Dashboard & Pengembalian
        Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');
        Route::post('/loan/{loan}/return', [StaffController::class, 'returnBook'])->name('loan.return');
        
        // Manajemen Denda
        Route::get('/fines', [StaffController::class, 'fines'])->name('fines');
        Route::post('/fines/{loan}/pay', [StaffController::class, 'markAsPaid'])->name('fines.pay');
    });

// ==========================================
// 3. GROUP ROUTE STUDENT (MAHASISWA)
// ==========================================
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        
        // Katalog & Detail Buku
        Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
        Route::get('/books/{book:slug}', [StudentController::class, 'show'])->name('books.show');
        
        // Review Buku
        Route::post('/books/{book}/review', [StudentController::class, 'storeReview'])->name('books.review');
        
        // Transaksi Peminjaman
        Route::post('/books/{book}/loan', [LoanController::class, 'store'])->name('books.loan');
        Route::get('/my-loans', [LoanController::class, 'index'])->name('loans');
    });

require __DIR__.'/auth.php';