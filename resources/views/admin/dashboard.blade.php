<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 flex items-center justify-between transition hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Koleksi Buku</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBooks }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 flex items-center justify-between transition hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Mahasiswa Terdaftar</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalUsers }}</p>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 flex items-center justify-between transition hover:shadow-md">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Peminjaman Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $activeLoans }}</p>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Aksi Cepat
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    
                    <a href="{{ route('admin.books.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-100 hover:bg-blue-50 hover:border-blue-200 transition group">
                        <div class="p-3 bg-white rounded-lg shadow-sm group-hover:bg-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-bold text-gray-900 group-hover:text-blue-700">Kelola Buku</p>
                            <p class="text-sm text-gray-500">Tambah atau edit koleksi</p>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-100 hover:bg-indigo-50 hover:border-indigo-200 transition group">
                        <div class="p-3 bg-white rounded-lg shadow-sm group-hover:bg-indigo-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-bold text-gray-900 group-hover:text-indigo-700">Kelola Pengguna</p>
                            <p class="text-sm text-gray-500">Staff & Mahasiswa</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.reports') }}" class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-100 hover:bg-green-50 hover:border-green-200 transition group">
                        <div class="p-3 bg-white rounded-lg shadow-sm group-hover:bg-green-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="font-bold text-gray-900 group-hover:text-green-700">Laporan Analitik</p>
                            <p class="text-sm text-gray-500">Statistik perpustakaan</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>