<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.books.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    + Tambah Buku Baru
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-3 border-b">Judul</th>
                                <th class="p-3 border-b">Penulis</th>
                                <th class="p-3 border-b">Kategori</th>
                                <th class="p-3 border-b">Stok</th>
                                <th class="p-3 border-b">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">{{ $book->title }}</td>
                                <td class="p-3 border-b">{{ $book->author }}</td>
                                <td class="p-3 border-b">{{ $book->category }}</td>
                                <td class="p-3 border-b">{{ $book->stock }}</td>
                                <td class="p-3 border-b">
                                    <a href="#" class="text-blue-500 hover:underline">Edit</a> | 
                                    <a href="#" class="text-red-500 hover:underline">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>