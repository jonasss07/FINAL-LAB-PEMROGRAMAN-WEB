<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Laporan Perpustakaan') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">Total Pendapatan Denda</h3>
                <p class="text-4xl font-bold text-green-600">Rp {{ number_format($totalFines, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Akumulasi denda keterlambatan yang sudah dibayar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">📚 5 Buku Terpopuler</h3>
                    <ul class="divide-y divide-gray-100">
                        @foreach($popularBooks as $book)
                            <li class="py-3 flex justify-between">
                                <span>{{ $book->title }}</span>
                                <span class="font-bold text-blue-600">{{ $book->loans_count }}x Pinjam</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">🏆 5 Mahasiswa Terrajin</h3>
                    <ul class="divide-y divide-gray-100">
                        @foreach($topUsers as $user)
                            <li class="py-3 flex justify-between">
                                <span>{{ $user->name }}</span>
                                <span class="font-bold text-indigo-600">{{ $user->loans_count }}x Pinjam</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>