<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Judul Buku</label>
                            <input type="text" name="title" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Penulis</label>
                            <input type="text" name="author" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Penerbit</label>
                            <input type="text" name="publisher" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                        </div>

                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="block font-medium text-sm text-gray-700">Tahun</label>
                                <input type="number" name="publication_year" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                            <div class="w-1/2">
                                <label class="block font-medium text-sm text-gray-700">Stok</label>
                                <input type="number" name="stock" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1" required>
                            </div>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Kategori</label>
                            <select name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1">
                                <option value="Teknologi">Teknologi</option>
                                <option value="Sejarah">Sejarah</option>
                                <option value="Fiksi">Fiksi</option>
                                <option value="Sains">Sains</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700">Cover Buku</label>
                            <input type="file" name="cover_image" class="border-gray-300 rounded-md block w-full mt-1">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Simpan Buku
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>