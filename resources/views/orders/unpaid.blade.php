@extends('layouts.app')

@section('title', 'Pesanan Belum Dibayar')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
    <div class="flex items-center justify-between gap-3">
        <div>
            <h1 class="font-serif text-2xl sm:text-3xl text-white flex items-center gap-2">
                <i data-lucide="clock" class="w-6 h-6 text-amber-300"></i>
                Pesanan Belum Dibayar
            </h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">
                Daftar pesanan yang masih menunggu pembayaran atau konfirmasi.
            </p>
        </div>
        <a href="{{ route('orders.paid') }}" class="text-xs sm:text-sm text-emerald-300 hover:text-emerald-200 flex items-center gap-1">
            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
            Lihat yang Sudah Dibayar
        </a>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @php
            $unpaidPurchases = auth()->user()->purchases()->where('status', 'pending')->get();
            $unpaidSubscriptions = auth()->user()->subscriptions()->where('status', 'pending')->get();
            $allUnpaid = [];
            
            foreach ($unpaidPurchases as $purchase) {
                $allUnpaid[] = [
                    'type' => 'purchase',
                    'data' => $purchase,
                    'created_at' => $purchase->created_at,
                ];
            }
            
            foreach ($unpaidSubscriptions as $subscription) {
                $allUnpaid[] = [
                    'type' => 'subscription',
                    'data' => $subscription,
                    'created_at' => $subscription->created_at,
                ];
            }
            
            usort($allUnpaid, function($a, $b) {
                return $b['created_at']->timestamp - $a['created_at']->timestamp;
            });
        @endphp

        @if(count($allUnpaid) > 0)
            @foreach($allUnpaid as $item)
                @if($item['type'] === 'purchase')
                    @php $purchase = $item['data']; @endphp
                    <div class="ui-card rounded-2xl border border-amber-500/30 p-4 sm:p-5">
                        <div class="grid md:grid-cols-4 gap-4 items-center">
                            <!-- Book Info -->
                            <div class="md:col-span-2 flex gap-4">
                                @if($purchase->book->cover_image)
                                    <img src="{{ asset('storage/' . $purchase->book->cover_image) }}" 
                                         alt="{{ $purchase->book->title }}" 
                                         class="w-14 h-20 sm:w-16 sm:h-24 object-cover rounded-xl ">
                                @else
                                    <div class="w-14 h-20 sm:w-16 sm:h-24 bg-white/5 rounded-xl flex items-center justify-center text-[10px] text-gray-500 ">
                                        No Image
                                    </div>
                                @endif
                                <div class="space-y-1">
                                    <h3 class="text-sm sm:text-base font-medium text-white">
                                        {{ $purchase->book->title }}
                                    </h3>
                                    <p class="text-[11px] text-gray-400">
                                        {{ $purchase->book->author ?? 'Unknown Author' }}
                                    </p>
                                    <p class="text-[11px] text-gray-500 mt-1">
                                        Pesanan: {{ $purchase->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="text-left md:text-right text-sm">
                                <p class="text-[11px] text-gray-400 mb-1">Total</p>
                                <p class="text-lg font-semibold text-amber-300">
                                    Rp {{ number_format($purchase->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col gap-2 text-xs">
                                @php $payment = $purchase->payments()->first(); @endphp
                                @if($payment)
                                    <a href="{{ route('payments.show', $payment->id) }}" 
                                       class="text-center px-3 py-1.5 rounded-full bg-amber-500/90 text-black font-medium hover:bg-amber-400 transition-colors">
                                        Lihat Pembayaran
                                    </a>
                                @else
                                    <a href="{{ route('payments.create-purchase', $purchase->id) }}" 
                                       class="text-center px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                                        Bayar Sekarang
                                    </a>
                                @endif
                                <a href="{{ route('books.show', $purchase->book->id) }}" 
                                   class="text-center px-3 py-1.5 rounded-full bg-white/5 text-gray-100 hover:bg-white/10 transition-colors">
                                    Detail Buku
                                </a>
                            </div>
                        </div>

                        @php $payment = $purchase->payments()->first(); @endphp
                        @if($payment)
                            <div class="mt-3 pt-3 border-t border-white/10 flex items-center justify-between gap-2 text-[11px] text-gray-500">
                                <div>
                                    <p class="uppercase tracking-[0.15em] text-gray-500 mb-0.5">Status Pembayaran</p>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-amber-500/15 text-amber-200 border border-amber-500/30">
                                        ⏳ {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                                <div class="text-right">
                                    <p class="uppercase tracking-[0.15em] text-gray-500 mb-0.5">Transaction ID</p>
                                    <p class="font-mono text-gray-300">{{ $payment->transaction_id }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                @else
                    @php $subscription = $item['data']; @endphp
                    <div class="ui-card rounded-2xl border border-amber-500/30 p-4 sm:p-5">
                        <div class="grid md:grid-cols-4 gap-4 items-center">
                            <!-- Subscription Info -->
                            <div class="md:col-span-2 flex gap-4 items-center">
                                <div class="w-10 h-10 rounded-full bg-amber-500/15 flex items-center justify-center border border-amber-400/40">
                                    <i data-lucide="badge-alert" class="w-5 h-5 text-amber-300"></i>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-sm sm:text-base font-medium text-white">
                                        Langganan {{ ucfirst($subscription->plan) }}
                                    </h3>
                                    <p class="text-[11px] text-gray-400">
                                        @if($subscription->plan === 'monthly')
                                            Akses unlimited selama 1 bulan
                                        @else
                                            Akses unlimited selama 1 tahun
                                        @endif
                                    </p>
                                    <p class="text-[11px] text-gray-500 mt-1">
                                        Pesanan: {{ $subscription->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="text-left md:text-right text-sm">
                                <p class="text-[11px] text-gray-400 mb-1">Total</p>
                                <p class="text-lg font-semibold text-amber-300">
                                    Rp {{ number_format($subscription->amount, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col gap-2 text-xs">
                                @php $payment = $subscription->payment; @endphp
                                @if($payment)
                                    <a href="{{ route('payments.show', $payment->id) }}" 
                                       class="text-center px-3 py-1.5 rounded-full bg-amber-500/90 text-black font-medium hover:bg-amber-400 transition-colors">
                                        Lihat Pembayaran
                                    </a>
                                @else
                                    <a href="{{ route('payments.create-subscription', $subscription->id) }}" 
                                       class="text-center px-3 py-1.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                                        Bayar Sekarang
                                    </a>
                                @endif
                            </div>
                        </div>

                        @php $payment = $subscription->payment; @endphp
                        @if($payment)
                            <div class="mt-3 pt-3 border-t border-white/10 flex items-center justify-between gap-2 text-[11px] text-gray-500">
                                <div>
                                    <p class="uppercase tracking-[0.15em] text-gray-500 mb-0.5">Status Pembayaran</p>
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-amber-500/15 text-amber-200 border border-amber-500/30">
                                        ⏳ {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                                <div class="text-right">
                                    <p class="uppercase tracking-[0.15em] text-gray-500 mb-0.5">Transaction ID</p>
                                    <p class="font-mono text-gray-300">{{ $payment->transaction_id }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        @else
            <!-- Empty State -->
            <div class="ui-card rounded-3xl  p-12 text-center space-y-4">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/5 ">
                    <i data-lucide="sparkles" class="w-7 h-7 text-amber-300"></i>
                </div>
                <h2 class="font-serif text-2xl text-white">Tidak Ada Pesanan Menunggu Pembayaran</h2>
                <p class="text-sm text-gray-400 max-w-md mx-auto">
                    Semua pesanan Anda sudah dibayar, atau Anda belum membuat pesanan baru.
                </p>

                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('books.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium hover:shadow-lg hover:shadow-amber-500/25 transition-all">
                        <i data-lucide="library" class="w-4 h-4"></i>
                        Jelajahi Buku
                    </a>
                    <a href="{{ route('orders.paid') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-white/5 text-gray-100 text-sm font-medium hover:bg-white/10 transition-all">
                        <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                        Pesanan Dibayar
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
