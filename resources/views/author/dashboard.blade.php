@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="min-h-screen bg-[#0f0f0f] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-white">Dashboard Petugas</h1>
        <div class="ui-card rounded-[28px]  p-6">
            <p class="text-gray-300">Selamat datang, {{ auth()->user()->name }}!<br>
            Ini adalah halaman dashboard khusus petugas.</p>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('author.books.index') }}" class="inline-flex items-center justify-center ui-btn-primary">Kelola Buku</a>
                <a href="{{ route('author.borrows.index') }}" class="inline-flex items-center justify-center rounded-full  bg-white/10 px-5 py-3 text-sm font-semibold text-gray-200 hover:bg-white/20 transition">Kelola Peminjaman</a>
                <a href="{{ route('author.payment-methods.index') }}" class="inline-flex items-center justify-center rounded-full  bg-white/10 px-5 py-3 text-sm font-semibold text-gray-200 hover:bg-white/20 transition">Metode Pembayaran</a>
                <a href="{{ route('author.payments.index') }}" class="inline-flex items-center justify-center rounded-full  bg-white/10 px-5 py-3 text-sm font-semibold text-gray-200 hover:bg-white/20 transition">Pembayaran</a>
            </div>
        </div>
    </div>
</div>
@endsection
