<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku Pinjaman Saya') }}
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
                    
                    @if($loans->isEmpty())
                        <div class="text-center py-10 text-gray-500">
                            Anda belum meminjam buku apapun. 
                            <a href="{{ route('student.dashboard') }}" class="text-indigo-600 hover:underline">Cari buku sekarang</a>.
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3">Buku</th>
                                        <th class="px-6 py-3">Tanggal Pinjam</th>
                                        <th class="px-6 py-3">Batas Kembali</th>
                                        <th class="px-6 py-3">Status</th>
                                        <th class="px-6 py-3">Denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loans as $loan)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $loan->book->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $loan->loan_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-red-600 font-bold">
                                            {{ $loan->due_date->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($loan->status == 'borrowed')
                                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Dipinjam</span>
                                            @else
                                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded">Dikembalikan</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($loan->fine_amount > 0)
                                                <span class="text-red-600 font-bold">Rp {{ number_format($loan->fine_amount) }}</span>
                                                @if(!$loan->is_fine_paid)
                                                    <span class="text-xs bg-red-600 text-white px-1 rounded">Belum Lunas</span>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $loans->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>