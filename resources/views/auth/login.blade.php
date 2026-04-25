@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#060606] py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl grid gap-10 lg:grid-cols-2">
        <div class="hidden lg:flex flex-col justify-center ui-card rounded-[32px]  p-10 shadow-2xl">
            <span class="text-xs uppercase tracking-[0.35em] text-amber-300/80">Selamat Datang Kembali</span>
            <h2 class="mt-4 text-4xl font-semibold text-white leading-tight">Masuk dan lanjutkan membaca koleksi ebook premium.</h2>
            <p class="mt-5 text-sm text-gray-400 leading-relaxed">Akses buku favorit Anda, lihat riwayat pesanan, dan jalankan pembelajaran dengan pengalaman membaca yang elegan.</p>

            <div class="mt-10 space-y-4">
                <div class="rounded-3xl bg-white/5  p-5">
                    <p class="text-sm font-medium text-white">Keamanan Akun</p>
                    <p class="mt-2 text-sm text-gray-400">Semua data disimpan dengan aman dan sesi Anda terlindungi.</p>
                </div>
                <div class="rounded-3xl bg-white/5  p-5">
                    <p class="text-sm font-medium text-white">Akses Instan</p>
                    <p class="mt-2 text-sm text-gray-400">Masuk sekali untuk menikmati seluruh fitur di dalam platform.</p>
                </div>
            </div>
        </div>

        <div class="ui-card rounded-[32px]  p-10 shadow-2xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-semibold text-white">Masuk ke Akun Anda</h2>
                <p class="mt-3 text-sm text-gray-400">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-amber-300 hover:text-amber-200">Daftar sekarang</a></p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input id="email" name="email" type="email" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 @error('email') border-red-500 @enderror"
                            placeholder="nama@email.com" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                class="w-full rounded-2xl bg-white/5  px-4 py-3 pr-12 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            <button type="button" id="togglePassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-300 hover:text-white focus:outline-none transition-colors"
                                onclick="togglePasswordVisibility()">
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-gray-300">
                            <input id="remember" name="remember" type="checkbox"
                                class="h-4 w-4 rounded border-white/20 bg-black/20 text-amber-400 focus:ring-amber-400">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-amber-300 px-4 py-3 text-sm font-semibold text-black hover:bg-amber-200 transition-colors">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // Ubah ikon (mata terbuka)
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.487m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>';
        } else {
            passwordInput.type = 'password';
            // Ubah ikon kembali (mata tertutup)
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
        }
    }
</script>

