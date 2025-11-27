<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:flex gap-8"> 

                    <div class="w-full md:w-2/3">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="bg-indigo-100 text-sm px-3 py-1 rounded-full font-semibold">
                                    {{ $book->category }}
                                </span>
                                <h1 class="text-3xl font-bold text-gray-200 mt-3">{{ $book->title }}</h1>
                                <p class="text-lg text-gray-600">karya {{ $book->author }}</p>
                            </div>
                            <div class="flex items-center bg-yellow-100 px-3 py-1 rounded">
                                <span class="text-xl mr-1">★</span>
                                <span class="font-bold text-gray-200">4.5</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="block text-gray-500">Penerbit</span>
                                <span class="font-medium text-gray-200">{{ $book->publisher }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500">Tahun Terbit</span>
                                <span class="font-medium text-gray-200">{{ $book->publication_year }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500">Batas Pinjam</span>
                                <span class="font-medium text-gray-200">{{ $book->max_loan_days }} Hari</span>
                            </div>
                            <div>
                                <span class="block text-gray-500">Denda Keterlambatan</span>
                                <span class="font-medium text-red-600">Rp {{ number_format($book->fine_per_day, 0, ',', '.') }} / hari</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-bold text-gray-200 mb-2">Deskripsi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $book->description ?? 'Tidak ada deskripsi untuk buku ini.' }}
                            </p>
                        </div>

                        <div class="mt-8 border-t pt-6">
                     @if (session('error'))
                     <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Gagal!</strong>
                     <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

                    @if($book->stock > 0)
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-bold bg-green-100 px-4 py-2 rounded-lg">
                                Tersedia {{ $book->stock }} Buku
                            </span>
                            
                            <form action="{{ route('student.books.loan', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin meminjam buku ini?');">
                                @csrf
                                <button type="submit" class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition shadow-lg font-semibold">
                                    Ajukan Peminjaman
                                </button>
                            </form>
                        </div>
                    @else
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                                    <p class="font-bold">Stok Habis</p>
                                    <p>Maaf, buku ini sedang tidak tersedia untuk dipinjam.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>