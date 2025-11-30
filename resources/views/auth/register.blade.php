<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    <div class="flex min-h-screen flex-row-reverse">
        
        <div class="hidden lg:flex w-1/2 bg-indigo-600 items-center justify-center relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1507842217121-9e9f1479fb48?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Books">
            <div class="relative z-10 text-white text-center px-12">
                <h2 class="text-4xl font-bold mb-4">Bergabunglah Bersama Kami</h2>
                <p class="text-lg text-indigo-100">"Daftarkan diri Anda untuk akses tanpa batas ke ribuan koleksi buku digital universitas."</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h1>
                    <p class="text-sm text-gray-500 mt-2">Khusus Mahasiswa Universitas.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full p-3 border-gray-300 rounded-lg focus:ring-blue-500" 
                                      type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                                      placeholder="Nama Anda" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email Universitas')" />
                        <x-text-input id="email" class="block mt-1 w-full p-3 border-gray-300 rounded-lg focus:ring-blue-500" 
                                      type="email" name="email" :value="old('email')" required autocomplete="username" 
                                      placeholder="nim@student.univ.ac.id" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full p-3 border-gray-300 rounded-lg focus:ring-blue-500"
                                      type="password" name="password" required autocomplete="new-password" 
                                      placeholder="Minimal 8 karakter" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full p-3 border-gray-300 rounded-lg focus:ring-blue-500"
                                      type="password" name="password_confirmation" required autocomplete="new-password" 
                                      placeholder="Ulangi password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <button class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition duration-200 shadow-md">
                            {{ __('Daftar Sekarang') }}
                        </button>
                    </div>

                    <div class="mt-6 text-center text-sm text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk disini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>