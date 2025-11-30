<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
                <form method="GET" action="{{ route('student.dashboard') }}" class="flex flex-col md:flex-row gap-4">

                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Cari judul buku atau penulis...">
                    </div>

                    <div class="w-full md:w-48">
                        <select name="category" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                        Cari
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                        <div class="h-48 bg-gray-200 w-full object-cover">
                            @if ($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <span class="text-xs font-semibold bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                {{ $book->category }}
                            </span>

                            <h3 class="mt-2 text-lg font-bold text-gray-900 truncate" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $book->author }}</p>

                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $book->stock > 0 ? 'Stok: ' . $book->stock : 'Stok Habis' }}
                                </span>

                                <a href="{{ route('student.books.show', $book->slug) }}"
                                    class="text-sm bg-gray-800 text-white px-3 py-1 rounded hover:bg-gray-700 transition">
                                    Lihat Detail
                                </a>
                            </div>

                            <div class="flex items-center mt-1 mb-2">
                                <span class="text-yellow-400 text-sm mr-1">★</span>
                                <span class="text-xs font-bold text-gray-600">
                                    {{ number_format($book->average_rating, 1) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-gray-500">
                        Tidak ada buku yang ditemukan.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $books->withQueryString()->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
