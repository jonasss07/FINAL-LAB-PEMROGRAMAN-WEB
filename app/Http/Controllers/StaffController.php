<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    // 1. Dashboard Pegawai (Menampilkan Daftar Peminjaman Aktif)
    public function index()
    {
        // Ambil semua data pinjaman yang statusnya masih 'borrowed'
        // Kita load relasi user dan book agar bisa menampilkan nama peminjam & judul buku
        $activeLoans = Loan::with(['user', 'book'])
                           ->where('status', 'borrowed')
                           ->orderBy('due_date', 'asc') // Urutkan dari yang paling mendekati jatuh tempo
                           ->paginate(10);

        return view('staff.index', compact('activeLoans'));
    }

    // 2. Proses Pengembalian Buku (Return Logic)
    public function returnBook(Request $request, Loan $loan)
    {
        // Gunakan Transaction agar data konsisten
        try {
            DB::transaction(function () use ($loan) {
                $returnDate = Carbon::now();
                $dueDate = Carbon::parse($loan->due_date);
                
                $fineAmount = 0;
                $isFinePaid = true;

                // LOGIKA HITUNG DENDA OTOMATIS
                // Jika tanggal kembali lebih besar dari tanggal jatuh tempo (Terlambat)
                if ($returnDate->gt($dueDate)) {
                    // Hitung selisih hari (hanya menghitung hari penuh)
                    $daysLate = $returnDate->diffInDays($dueDate);
                    
                    // Ambil denda per hari dari tabel buku
                    $finePerDay = $loan->book->fine_per_day;
                    
                    // Total denda
                    $fineAmount = $daysLate * $finePerDay;
                    $isFinePaid = false; // Status denda belum lunas
                }

                // Update Data Peminjaman
                $loan->update([
                    'return_date' => $returnDate,
                    'status' => 'returned',
                    'fine_amount' => $fineAmount,
                    'is_fine_paid' => $isFinePaid,
                ]);

                // Update Stok Buku (Kembalikan stok +1)
                $loan->book->increment('stock');
            });

            // Pesan Notifikasi Berbeda jika ada denda atau tidak
            if ($loan->fresh()->fine_amount > 0) {
                return redirect()->back()->with('warning', 'Buku dikembalikan dengan KETERLAMBATAN. Total Denda: Rp ' . number_format($loan->fine_amount));
            }

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan. Tidak ada denda.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}
