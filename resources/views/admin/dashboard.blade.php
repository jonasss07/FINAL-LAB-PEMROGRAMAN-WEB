<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold">Total Buku</div>
                    <div class="text-4xl text-blue-600 font-bold mt-2">{{ $totalBooks }}</div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold">Mahasiswa Terdaftar</div>
                    <div class="text-4xl text-green-600 font-bold mt-2">{{ $totalUsers }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-900 text-xl font-bold">Peminjaman Aktif</div>
                    <div class="text-4xl text-red-600 font-bold mt-2">{{ $activeLoans }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Aksi Cepat</h3>
                <div class="flex gap-4">
                    <a href="{{ route('admin.books') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kelola Buku</a>
                    <a href="#" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kelola User (Coming Soon)</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>