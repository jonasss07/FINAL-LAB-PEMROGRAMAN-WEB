<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\StaffController; 
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome'); // Homepage umum
});

// Route Pengarah Dashboard (Redirect based on role)
Route::get('/dashboard', function () {
    $role = Auth::user()->role;
    
    return match($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        'student' => redirect()->route('student.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');


// Group Route ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function() { return "Halaman Admin Dashboard"; })->name('dashboard');
});

// Group Route STAFF (Pegawai)
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', function() { return "Halaman Staff Dashboard"; })->name('dashboard');
});

// Group Route STUDENT (Mahasiswa)
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', function() { return "Halaman Mahasiswa Dashboard"; })->name('dashboard');
});

require __DIR__.'/auth.php';