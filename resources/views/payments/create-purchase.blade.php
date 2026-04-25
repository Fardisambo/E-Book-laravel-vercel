@extends('layouts.app')

@section('title', 'Pilih Metode Pembayaran - Pembelian Buku')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 space-y-6">
    <!-- Breadcrumb -->
    <div class="flex items-center justify-between gap-3">
        <a href="{{ route('books.show', $purchase->book->id) }}" class="text-xs sm:text-sm text-amber-300 hover:text-amber-200 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Buku
        </a>
        <span class="text-[11px] text-gray-500">Langkah 2 dari 2</span>
    </div>

    <div class="ui-card rounded-3xl  p-6 sm:p-8">
        <h1 class="font-serif text-2xl sm:text-3xl text-white mb-1">Pilih Metode Pembayaran</h1>
        <p class="text-xs sm:text-sm text-gray-400 mb-6">Selesaikan pembelian buku Anda dengan metode pembayaran yang tersedia.</p>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Order Summary -->
            <div class="md:col-span-1">
                <div class="ui-card rounded-2xl p-5  sticky top-4">
                    <h2 class="font-serif text-lg text-white mb-3">Ringkasan Pembelian</h2>
                    
                    <div class="space-y-3 pb-4 border-b border-white/10 text-xs text-gray-200">
                        <div>
                            <p class="text-[11px] text-gray-400">Buku</p>
                            <p class="font-medium text-gray-100">{{ $purchase->book->title }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-gray-400">Penulis</p>
                            <p class="font-medium text-gray-100">{{ $purchase->book->author ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 space-y-2 text-xs text-gray-200">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Harga Buku:</span>
                            <span class="font-medium text-gray-100">Rp {{ number_format($purchase->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between" id="feeDisplay" class="hidden">
                            <span class="text-gray-400">Biaya Transaksi:</span>
                            <span class="font-medium text-gray-100" id="feeAmount">Rp 0</span>
                        </div>
                        <div class="border-t border-white/10 pt-2 mt-2 flex justify-between items-center">
                            <span class="font-semibold text-gray-200 text-sm">Total:</span>
                            <span class="font-semibold text-lg text-amber-300" id="totalAmount">Rp {{ number_format($purchase->price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <p class="mt-4 text-[11px] text-gray-500">
                        Biaya transaksi akan dihitung otomatis setelah Anda memilih metode pembayaran.
                    </p>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="md:col-span-2">
                <form action="{{ route('payments.store.purchase', $purchase->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-4 mb-6">
                        @forelse($paymentMethods as $index => $method)
                            <label class="block">
                                <input type="radio" name="payment_method_id" value="{{ $method->id }}" 
                                    class="payment-method-radio" 
                                    data-fee-percentage="{{ $method->fee_percentage ?? 0 }}"
                                    data-fee-fixed="{{ $method->fee_fixed ?? 0 }}"
                                    data-amount="{{ $purchase->price }}"
                                    @if($index === 0) checked @endif>
                                
                                <div class="block ui-card border rounded-2xl p-4 cursor-pointer transition-all mt-2
                                    @if($index === 0) border-amber-500/60 bg-amber-500/5 @else border-white/12 hover:border-white/30 @endif">
                                    
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-100 text-sm sm:text-base">{{ $method->name }}</h3>
                                            
                                            @if($method->description)
                                                <p class="text-xs text-gray-400 mt-1">{{ $method->description }}</p>
                                            @endif

                                            <div class="flex items-center gap-2 mt-3 text-[11px]">
                                                <span class="inline-block px-2 py-1 font-semibold rounded
                                                    @if($method->type === 'bank')
                                                        bg-blue-500/20 text-blue-200
                                                    @elseif($method->type === 'e-wallet')
                                                        bg-purple-500/20 text-purple-200
                                                    @elseif($method->type === 'cash')
                                                        bg-green-500/20 text-green-200
                                                    @else
                                                        bg-gray-500/20 text-gray-200
                                                    @endif
                                                ">
                                                    {{ ucfirst(str_replace('-', ' ', $method->type)) }}
                                                </span>

                                                @if(($method->fee_percentage ?? 0) > 0 || ($method->fee_fixed ?? 0) > 0)
                                                    <span class="inline-block px-2 py-1 font-medium bg-orange-500/20 text-orange-200 rounded">
                                                        Biaya: {{ number_format($method->fee_percentage ?? 0, 1) }}%
                                                        @if(($method->fee_fixed ?? 0) > 0)
                                                            + Rp {{ number_format($method->fee_fixed ?? 0, 0, ',', '.') }}
                                                        @endif
                                                    </span>
                                                @else
                                                    <span class="inline-block px-2 py-1 font-medium bg-emerald-500/20 text-emerald-200 rounded">
                                                        Gratis biaya transaksi
                                                    </span>
                                                @endif
                                            </div>

                                            @if($method->account_number)
                                                <div class="mt-3 p-3 bg-black/30 rounded-xl  text-xs text-gray-200">
                                                    <p>No. Rekening: <span class="font-mono font-semibold">{{ $method->account_number }}</span></p>
                                                    @if(($method->account_holder ?? $method->account_name))
                                                        <p>Atas Nama: <span class="font-semibold">{{ $method->account_holder ?? $method->account_name }}</span></p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        <div class="ml-4 flex-shrink-0">
                                            <div class="flex items-center h-5">
                                                <input type="radio" name="payment_method_id" value="{{ $method->id }}" 
                                                    class="w-4 h-4 text-[#FF2D20] border-gray-300 focus:ring-[#FF2D20]"
                                                    style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-yellow-800">Tidak ada metode pembayaran yang tersedia. Silakan hubungi admin.</p>
                            </div>
                        @endforelse
                    </div>

                    @error('payment_method_id')
                        <p class="text-red-300 text-xs mb-3">{{ $message }}</p>
                    @enderror

                    <div class="flex gap-3">
                        <a href="{{ route('books.show', $purchase->book->id) }}" 
                            class="flex-1 text-center border border-white/15 text-xs sm:text-sm text-gray-100 px-4 py-2.5 rounded-full hover:bg-white/5 transition-colors font-medium">
                            Batal
                        </a>
                        <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-amber-600 to-amber-500 text-black px-4 py-2.5 rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-colors text-xs sm:text-sm font-medium">
                            Lanjut Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.payment-method-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        const feePercentage = parseFloat(this.dataset.feePercentage);
        const feeFixed = parseFloat(this.dataset.feeFixed);
        const amount = parseFloat(this.dataset.amount);
        
        // Hitung biaya
        const fee = (amount * feePercentage / 100) + feeFixed;
        const total = amount + fee;
        
        // Update display
        const feeDisplay = document.getElementById('feeDisplay');
        const feeAmount = document.getElementById('feeAmount');
        const totalAmount = document.getElementById('totalAmount');
        
        if (fee > 0) {
            feeDisplay.classList.remove('hidden');
            feeAmount.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(fee));
        } else {
            feeDisplay.classList.add('hidden');
        }
        
        totalAmount.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(total));
        
        // Update border color di label
        document.querySelectorAll('label .block').forEach(div => {
            div.classList.remove('border-[#FF2D20]', 'bg-red-50');
            div.classList.add('border-gray-200', 'hover:border-gray-300');
        });
        this.closest('label').querySelector('.block').classList.remove('border-gray-200', 'hover:border-gray-300');
        this.closest('label').querySelector('.block').classList.add('border-[#FF2D20]', 'bg-red-50');
    });
});

// Trigger change untuk radio pertama jika ada
const firstRadio = document.querySelector('.payment-method-radio');
if (firstRadio && firstRadio.checked) {
    firstRadio.dispatchEvent(new Event('change'));
}
</script>
@endsection
