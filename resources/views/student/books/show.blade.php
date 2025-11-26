<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:flex gap-8">
                    
                    <div class="w-full md:w-1/3 mb-6 md:mb-0">
                        <div class="rounded-lg overflow-hidden shadow-lg border border-gray-200">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-auto">
                            @else
                                <div class="bg-gray-200 h-96 flex items-center justify-center text-gray-500">
                                    No Image Available
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="w-full md:w-2/3">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="bg-indigo-100 text-indigo-800 text-sm px-3 py-1 rounded-full font-semibold">
                                    {{ $book->category }}
                                </span>
                                <h1 class="text-3xl font-bold text-gray-900 mt-3">{{ $book->title }}</h1>
                                <p class="text-lg text-gray-600">karya {{ $book->author }}</p>
                            </div>
                            <div class="flex items-center bg-yellow-100 px-3 py-1 rounded">
                                <span class="text-yellow-600 text-xl mr-1">★</span>
                                <span class="font-bold text-gray-700">4.5</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="block text-gray-500">Penerbit</span>
                                <span class="font-medium text-gray-900">{{ $book->publisher }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500">Tahun Terbit</span>
                                <span class="font-medium text-gray-900">{{ $book->publication_year }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500">Batas Pinjam</span>
                                <span class="font-medium text-gray-900">{{ $book->max_loan_days }} Hari</span>
                            </div>
                            <div>
                                <span class="block text-gray-500">Denda Keterlambatan</span>
                                <span class="font-medium text-red-600">Rp {{ number_format($book->fine_per_day, 0, ',', '.') }} / hari</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Deskripsi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{ $book->description ?? 'Tidak ada deskripsi untuk buku ini.' }}
                            </p>
                        </div>

                        <div class="mt-8 border-t pt-6">
                            @if($book->stock > 0)
                                <div class="flex items-center justify-between">
                                    <span class="text-green-600 font-bold bg-green-100 px-4 py-2 rounded-lg">
                                        Tersedia {{ $book->stock }} Buku
                                    </span>
                                    
                                    <form action="#" method="POST"> @csrf
                                        <button type="button" class="bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition shadow-lg font-semibold">
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