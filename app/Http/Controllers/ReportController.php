<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // 1. Buku Terpopuler (Paling sering dipinjam)
        $popularBooks = Book::withCount('loans')
                            ->orderBy('loans_count', 'desc')
                            ->take(5)
                            ->get();

        // 2. Statistik Peminjaman per Bulan (Tahun ini)
        $monthlyLoans = Loan::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
                            ->whereYear('created_at', date('Y'))
                            ->groupBy('month')
                            ->pluck('total', 'month')
                            ->all();

        // 3. Total Denda Terkumpul
        $totalFines = Loan::where('is_fine_paid', true)->sum('fine_amount');

        // 4. User Terrajin (Paling sering meminjam)
        $topUsers = User::withCount('loans')
                        ->where('role', 'student')
                        ->orderBy('loans_count', 'desc')
                        ->take(5)
                        ->get();

        return view('admin.reports.index', compact('popularBooks', 'monthlyLoans', 'totalFines', 'topUsers'));
    }
}