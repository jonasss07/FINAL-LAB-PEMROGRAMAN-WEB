<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookController; // Pastikan Controller ini di-import

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Ambil 4 buku terbaru untuk ditampilkan di landing page
    $featuredBooks = Book::latest()->take(4)->get();
    return view('welcome', compact('featuredBooks'));
});

// Redirect Dashboard sesuai Role
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
// GROUP ROUTE ADMIN
// ==========================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.') // <--- PENTING: Ini yang membuat route menjadi 'admin.books.index'
    ->group(function () {
        
        // Dashboard Admin
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        
        // Manajemen Buku (Resource Controller)
        // Otomatis membuat: admin.books.index, admin.books.create, admin.books.store, dll.
        Route::resource('books', BookController::class); 
    });

// ==========================================
// GROUP ROUTE STAFF (PEGAWAI)
// ==========================================
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {
        
        Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');
        Route::post('/loan/{loan}/return', [StaffController::class, 'returnBook'])->name('loan.return');
        
        // Manajemen Denda
        Route::get('/fines', [StaffController::class, 'fines'])->name('fines');
        Route::post('/fines/{loan}/pay', [StaffController::class, 'markAsPaid'])->name('fines.pay');
    });

// ==========================================
// GROUP ROUTE STUDENT (MAHASISWA)
// ==========================================
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        
        Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
        Route::get('/books/{book:slug}', [StudentController::class, 'show'])->name('books.show');
        Route::post('/books/{book}/review', [StudentController::class, 'storeReview'])->name('books.review');
        
        // Transaksi
        Route::post('/books/{book}/loan', [LoanController::class, 'store'])->name('books.loan');
        Route::get('/my-loans', [LoanController::class, 'index'])->name('loans');
    });

require __DIR__.'/auth.php';