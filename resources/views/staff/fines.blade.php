<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Denda Tertunggak') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-red-50">
                                <tr>
                                    <th class="px-6 py-3">Nama Mahasiswa</th>
                                    <th class="px-6 py-3">Buku Dikembalikan</th>
                                    <th class="px-6 py-3">Tanggal Kembali</th>
                                    <th class="px-6 py-3">Total Denda</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($unpaidFines as $loan)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $loan->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $loan->book->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $loan->return_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-red-600 font-bold text-lg">
                                                Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <form action="{{ route('staff.fines.pay', $loan->id) }}" method="POST" onsubmit="return confirm('Konfirmasi: Denda sebesar Rp {{ number_format($loan->fine_amount) }} telah dibayar LUNAS oleh mahasiswa?');">
                                                @csrf
                                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 transition font-semibold">
                                                    ✔ Tandai Lunas
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                            <p class="text-lg">Tidak ada data denda tertunggak.</p>
                                            <p class="text-sm">Semua mahasiswa tertib atau denda sudah lunas.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $unpaidFines->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>