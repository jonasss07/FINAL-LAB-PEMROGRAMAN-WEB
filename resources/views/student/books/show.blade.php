<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 md:flex gap-8">
                    
                    <div class="w-full md:w-1/3 mb-6 md:mb-0">
                        <div class="rounded-lg overflow-hidden shadow-lg border border-gray-200">
                            @if($book->cover_image)
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-auto">
                            @else
                                <div class="bg-gray-200 h-96 flex items-center justify-center text-gray-500">No Image</div>
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
                                <span class="font-bold text-gray-700">{{ number_format($book->average_rating, 1) }}</span>
                                <span class="text-xs text-gray-500 ml-1">({{ $book->reviews->count() }} ulasan)</span>
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
                                {{ $book->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                        </div>

                        <div class="mt-8 border-t pt-6">
                            @if($book->stock > 0)
                                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                    <span class="text-green-600 font-bold bg-green-100 px-4 py-2 rounded-lg">
                                        ✅ Tersedia {{ $book->stock }} Buku
                                    </span>
                                    <form action="{{ route('student.books.loan', $book->id) }}" method="POST" class="w-full sm:w-auto">
                                        @csrf
                                        <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin meminjam buku {{ $book->title }}?')"
                                            class="w-full sm:w-auto px-6 py-3 rounded-lg transition shadow-lg font-bold text-center">
                                            Ajukan Peminjaman
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                                    <p class="font-bold">Stok Habis</p>
                                    <p>Buku ini sedang tidak tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Tulis Ulasan</h3>
                        
                        @if($hasReviewed)
                            <div class="bg-green-50 text-green-700 p-4 rounded text-sm">
                                ✔ Anda sudah memberikan ulasan untuk buku ini. Terima kasih!
                            </div>
                        @elseif($hasBorrowed)
                            <form action="{{ route('student.books.review', $book->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <select name="rating" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="5">⭐⭐⭐⭐⭐ (5 - Sempurna)</option>
                                        <option value="4">⭐⭐⭐⭐ (4 - Bagus)</option>
                                        <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                                        <option value="2">⭐⭐ (2 - Kurang)</option>
                                        <option value="1">⭐ (1 - Buruk)</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                                    <textarea name="comment" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Apa pendapat Anda tentang buku ini?"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded hover:bg-gray-700 transition">
                                    Kirim Ulasan
                                </button>
                            </form>
                        @else
                            <div class="bg-gray-50 text-gray-500 p-4 rounded text-sm italic">
                                Anda harus meminjam dan mengembalikan buku ini terlebih dahulu sebelum dapat memberikan ulasan.
                            </div>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Ulasan Pembaca ({{ $book->reviews->count() }})</h3>
                        
                        @forelse($book->reviews as $review)
                            <div class="border-b border-gray-100 pb-6 mb-6 last:border-0 last:mb-0 last:pb-0">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-xs">
                                            {{ substr($review->user->name, 0, 2) }}
                                        </div>
                                        <span class="font-semibold text-gray-900">{{ $review->user->name }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex items-center mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="{{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}">★</span>
                                    @endfor
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        @empty
                            <div class="text-center py-10 text-gray-400">
                                Belum ada ulasan untuk buku ini. Jadilah yang pertama!
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>