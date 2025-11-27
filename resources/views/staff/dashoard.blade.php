<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pegawai - Transaksi Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 mb-4" role="alert">
                    <p class="font-bold">Perhatian: Denda Diterapkan</p>
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Daftar Peminjaman Aktif (Belum Kembali)</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Nama Peminjam</th>
                                    <th class="px-6 py-3">Judul Buku</th>
                                    <th class="px-6 py-3">Tgl Pinjam</th>
                                    <th class="px-6 py-3">Jatuh Tempo</th>
                                    <th class="px-6 py-3">Status Waktu</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activeLoans as $loan)
                                    @php
                                        // Cek apakah sudah terlambat hari ini
                                        $isOverdue = \Carbon\Carbon::now()->gt($loan->due_date);
                                    @endphp
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $loan->user->name }}
                                            <br>
                                            <span class="text-xs text-gray-400">{{ $loan->user->email }}</span>
                                        </td>
                                        <td class="px-6 py-4">{{ $loan->book->title }}</td>
                                        <td class="px-6 py-4">{{ $loan->loan_date->format('d M Y') }}</td>
                                        <td class="px-6 py-4 font-bold">
                                            {{ $loan->due_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($isOverdue)
                                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                    Terlambat
                                                </span>
                                            @else
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                    Masih Berlaku
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <form action="{{ route('staff.loan.return', $loan->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pengembalian buku ini?');">
                                                @csrf
                                                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">
                                                    Proses Kembali
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada peminjaman aktif saat ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $activeLoans->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>