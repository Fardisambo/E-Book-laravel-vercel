@extends('layouts.app')

@section('title', 'Langganan')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="font-serif text-2xl sm:text-3xl text-white flex items-center gap-2">
                <i data-lucide="badge-check" class="w-6 h-6 text-amber-300"></i>
                Paket Langganan
            </h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">
                Nikmati akses penuh ke semua koleksi dengan paket bulanan atau tahunan.
            </p>
        </div>
        <a href="{{ route('orders.paid') }}" class="text-xs sm:text-sm text-amber-300 hover:text-amber-200 flex items-center gap-1">
            <i data-lucide="book-open-check" class="w-4 h-4"></i>
            Lihat Riwayat Pembelian
        </a>
    </div>

    @if($activeSubscription)
    <div class="ui-card rounded-2xl border border-emerald-500/30 p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-[11px] text-emerald-300 uppercase tracking-[0.2em] mb-1">Langganan Aktif</p>
            <p class="text-sm text-gray-100">
                {{ ucfirst($activeSubscription->plan) }} plan - berlaku hingga 
                <span class="text-emerald-200 font-medium">{{ $activeSubscription->expires_at->format('d M Y') }}</span>
            </p>
        </div>
        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-[11px] font-semibold bg-emerald-500/15 text-emerald-200 border border-emerald-500/30">
            <i data-lucide="check-circle-2" class="w-3 h-3"></i>
            Aktif
        </span>
    </div>
    @endif

    @if($pendingSubscription)
    <div class="ui-card rounded-2xl border border-amber-500/40 p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-[11px] text-amber-300 uppercase tracking-[0.2em] mb-1">Menunggu Pembayaran</p>
            <p class="text-sm text-gray-100">
                Pesanan {{ ucfirst($pendingSubscription->plan) }} (Rp {{ number_format($pendingSubscription->amount, 0, ',', '.') }}) masih menunggu pembayaran.
            </p>
        </div>
        <a href="{{ $pendingPayment ? route('payments.show', $pendingPayment->id) : route('payments.create-subscription', $pendingSubscription->id) }}" 
           class="inline-flex items-center justify-center bg-gradient-to-r from-amber-600 to-amber-500 text-black px-4 py-1.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors font-medium text-xs whitespace-nowrap">
            <i data-lucide="credit-card" class="w-4 h-4 mr-1"></i>
            Lanjutkan Pembayaran
        </a>
    </div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        <div class="ui-card rounded-2xl p-6 sm:p-8 ">
            <h2 class="font-serif text-xl text-white mb-3">Monthly Plan</h2>
            <div class="mb-5">
                <span class="text-3xl sm:text-4xl font-semibold text-amber-300">Rp {{ number_format($plans['monthly']->price ?? 50000, 0, ',', '.') }}</span>
                <span class="text-gray-400 text-sm">/bulan</span>
            </div>
            <p class="text-sm text-gray-300 mb-4">{{ $plans['monthly']->description ?? 'Akses membaca semua buku tanpa batas selama 1 bulan.' }}</p>
            <ul class="space-y-3 mb-6 text-sm text-gray-200">
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Akses membaca semua buku
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Tidak ada batasan halaman
                </li>
            </ul>
            <form action="{{ route('subscriptions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="monthly">
                <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-black py-2.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors text-sm font-medium">
                    Berlangganan Bulanan
                </button>
            </form>
        </div>

        <div class="ui-card rounded-2xl p-6 sm:p-8 border border-amber-500/50 relative">
            <div class="absolute top-0 right-0 bg-gradient-to-r from-amber-600 to-amber-400 text-black px-4 py-1 rounded-bl-xl text-[11px] font-semibold tracking-[0.18em] uppercase">
                Populer
            </div>
            <h2 class="font-serif text-xl text-white mb-3">Yearly Plan</h2>
            <div class="mb-5">
                <span class="text-3xl sm:text-4xl font-semibold text-amber-300">Rp {{ number_format($plans['yearly']->price ?? 500000, 0, ',', '.') }}</span>
                <span class="text-gray-400 text-sm">/tahun</span>
                <!-- <p class="text-xs text-emerald-300 mt-2">Harga dapat diatur oleh admin kapan saja.</p> -->
            </div>
            <p class="text-sm text-gray-300 mb-4">{{ $plans['yearly']->description ?? 'Akses membaca semua buku tanpa batas selama 1 tahun dengan harga hemat.' }}</p>
            <ul class="space-y-3 mb-6 text-sm text-gray-200">
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Akses membaca semua buku
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Tidak ada batasan halaman
                </li>
                <li class="flex items-center gap-2">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-300"></i>
                    Hemat 20% dari bulanan
                </li>
            </ul>
            <form action="{{ route('subscriptions.store') }}" method="POST">
                @csrf
                <input type="hidden" name="plan" value="yearly">
                <button type="submit" class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-black py-2.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors text-sm font-medium">
                    Berlangganan Tahunan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
