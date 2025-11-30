<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    <div class="flex min-h-screen">
        
        <div class="hidden lg:flex w-1/2 bg-blue-600 items-center justify-center relative overflow-hidden">
            <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 class="absolute inset-0 w-full h-full object-cover opacity-50" alt="Library">
            
            <div class="relative z-10 text-white text-center px-12">
                <h2 class="text-4xl font-bold mb-4">Selamat Datang Kembali!</h2>
                <p class="text-lg text-blue-100">"Membaca adalah jembatan ilmu. Login sekarang untuk melanjutkan petualangan literasi Anda."</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Masuk ke Akun</h1>
                    <p class="text-sm text-gray-500 mt-2">Masukkan kredensial Anda untuk mengakses perpustakaan.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full p-3 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                      type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                                      placeholder="nama@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full p-3 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      type="password" name="password" required autocomplete="current-password" 
                                      placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4 flex justify-between items-center">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-6">
                        <button class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 shadow-md">
                            {{ __('Log in') }}
                        </button>
                    </div>

                    <div class="mt-6 text-center text-sm text-gray-500">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar sebagai Mahasiswa</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>