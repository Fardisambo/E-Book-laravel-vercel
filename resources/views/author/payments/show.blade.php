@extends('layouts.app')

@section('title', 'Detail Pembayaran Buku Saya')

@section('content')
<div class="min-h-screen bg-[#0f0f0f] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Detail Pembayaran</h1>
                <p class="text-sm text-gray-400 mt-1">Informasi transaksi untuk buku Anda.</p>
            </div>
            <a href="{{ route('author.payments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-full  text-sm text-gray-200 hover:bg-white/10 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Pembayaran
            </a>
        </div>

        <div class="ui-card rounded-[32px]  p-6 space-y-5">
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Transaction ID</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold">{{ $payment->transaction_id }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Tanggal</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold">{{ $payment->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Pembeli</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold">{{ $payment->user?->name ?? 'Guest' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Status</p>
                    <span class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-[11px] font-semibold
                        @if($payment->status === 'completed') bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                        @elseif($payment->status === 'pending') bg-amber-500/15 text-amber-200 border border-amber-500/40
                        @else bg-red-500/15 text-red-200 border border-red-500/40 @endif">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Buku</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold">{{ $payment->paymentable->book->title ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Jumlah</p>
                    <p class="mt-2 text-sm text-amber-300 font-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                </div>
            </div>

            <div>
                <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Metode Pembayaran</p>
                <p class="mt-2 text-sm text-gray-200 font-semibold">{{ $payment->paymentMethod?->name ?? $payment->authorPaymentMethod?->name ?? '-' }}</p>
            </div>

            @php $selectedMethod = $payment->paymentMethod ?? $payment->authorPaymentMethod; @endphp
            @if($selectedMethod)
            <div class="grid gap-4 sm:grid-cols-2">
                @if($selectedMethod->account_number)
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">No. Rekening / Akun</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold">{{ $selectedMethod->account_number }}</p>
                </div>
                @endif
                @if(($selectedMethod->account_holder ?? $selectedMethod->account_name))
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Atas Nama</p>
                    <p class="mt-2 text-sm text-gray-200 font-semibold">{{ $selectedMethod->account_holder ?? $selectedMethod->account_name }}</p>
                </div>
                @endif
            </div>
            @endif

            @if($payment->paymentable->book->author)
            <div class="bg-white/5 rounded-3xl p-4 ">
                <p class="text-xs uppercase tracking-[0.22em] text-gray-500">Penulis Buku</p>
                <p class="mt-2 text-sm text-gray-200">{{ $payment->paymentable->book->author }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
