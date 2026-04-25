@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#060606] py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-5xl grid gap-10 lg:grid-cols-2">
        <div class="hidden lg:flex flex-col justify-center ui-card rounded-[32px]  p-10 shadow-2xl">
            <span class="text-xs uppercase tracking-[0.35em] text-amber-300/80">Bergabung dengan F-Collection</span>
            <h2 class="mt-4 text-4xl font-semibold text-white leading-tight">Daftar sekarang dan nikmati koleksi ebook premium.</h2>
            <p class="mt-5 text-sm text-gray-400 leading-relaxed">Dapatkan akses ke rekomendasi buku eksklusif, riwayat pembelian, serta pengalaman membaca yang didesain khusus untuk Anda.</p>

            <div class="mt-10 space-y-4">
                <div class="rounded-3xl bg-white/5  p-5">
                    <p class="text-sm font-medium text-white">Akses Lebih Cepat</p>
                    <p class="mt-2 text-sm text-gray-400">Masuk dengan satu akun untuk melihat koleksi lengkap dan pembaruan terbaru.</p>
                </div>
                <div class="rounded-3xl bg-white/5  p-5">
                    <p class="text-sm font-medium text-white">Keamanan Terjamin</p>
                    <p class="mt-2 text-sm text-gray-400">Data Anda disimpan dengan aman, dan privasi Anda adalah prioritas kami.</p>
                </div>
            </div>
        </div>

        <div class="ui-card rounded-[32px]  p-10 shadow-2xl">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-semibold text-white">Buat Akun Baru</h2>
                <p class="mt-3 text-sm text-gray-400">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-amber-300 hover:text-amber-200">Masuk di sini</a></p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 @error('name') border-red-500 @enderror"
                            placeholder="Nama Lengkap" value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

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
                        <input id="password" name="password" type="password" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400 @error('password') border-red-500 @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-amber-400"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit"
                    class="w-full rounded-2xl bg-amber-300 px-4 py-3 text-sm font-semibold text-black hover:bg-amber-200 transition-colors">
                    Daftar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
