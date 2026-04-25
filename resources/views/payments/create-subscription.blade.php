@extends('layouts.app')

@section('title', 'Pilih Metode Pembayaran - Langganan')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8 space-y-6">
    <!-- Breadcrumb -->
    <div class="flex items-center justify-between gap-3">
        <a href="{{ route('subscriptions.index') }}" class="text-xs sm:text-sm text-amber-300 hover:text-amber-200 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali ke Langganan
        </a>
        <span class="text-[11px] text-gray-500">Langkah 2 dari 2</span>
    </div>

    <div class="ui-card rounded-3xl  p-6 sm:p-8">
        <h1 class="font-serif text-2xl sm:text-3xl text-white mb-1">Pilih Metode Pembayaran</h1>
        <p class="text-xs sm:text-sm text-gray-400 mb-6">Selesaikan pembayaran untuk mengaktifkan langganan premium Anda.</p>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Order Summary -->
            <div class="md:col-span-1">
                <div class="ui-card rounded-2xl p-5  sticky top-4">
                    <h2 class="font-serif text-lg text-white mb-3">Ringkasan Langganan</h2>
                    
                    <div class="space-y-3 pb-4 border-b border-white/10 text-xs text-gray-200">
                        <div>
                            <p class="text-[11px] text-gray-400">Paket</p>
                            <p class="font-medium text-gray-100">
                                {{ ucfirst($subscription->plan) }} 
                                @if($subscription->plan === 'monthly')
                                    (1 Bulan)
                                @else
                                    (1 Tahun)
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-[11px] text-gray-400 mb-1">Status</p>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold
                                @if($subscription->status === 'active')
                                    bg-emerald-500/15 text-emerald-200 border border-emerald-500/40
                                @elseif($subscription->status === 'pending')
                                    bg-amber-500/15 text-amber-200 border border-amber-500/40
                                @else
                                    bg-gray-500/20 text-gray-200 border border-gray-500/40
                                @endif
                            ">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 space-y-2 text-xs text-gray-200">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Harga Langganan:</span>
                            <span class="font-medium text-gray-100">Rp {{ number_format($subscription->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between" id="feeDisplay" class="hidden">
                            <span class="text-gray-400">Biaya Transaksi:</span>
                            <span class="font-medium text-gray-100" id="feeAmount">Rp 0</span>
                        </div>
                        <div class="border-t border-white/10 pt-2 mt-2 flex justify-between items-center">
                            <span class="font-semibold text-gray-200 text-sm">Total:</span>
                            <span class="font-semibold text-lg text-amber-300" id="totalAmount">Rp {{ number_format($subscription->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <p class="mt-4 text-[11px] text-gray-500">
                        Biaya transaksi akan dihitung otomatis setelah Anda memilih metode pembayaran.
                    </p>
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="md:col-span-2">
                <form action="{{ route('payments.store.subscription', $subscription->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-4 mb-6">
                        @forelse($paymentMethods as $index => $method)
                            <label class="block">
                                <input type="radio" name="payment_method_id" value="{{ $method->id }}" 
                                    class="payment-method-radio" 
                                    data-fee-percentage="{{ $method->fee_percentage }}"
                                    data-fee-fixed="{{ $method->fee_fixed }}"
                                    data-amount="{{ $subscription->amount }}"
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

                                                @if($method->fee_percentage > 0 || $method->fee_fixed > 0)
                                                    <span class="inline-block px-2 py-1 font-medium bg-orange-500/20 text-orange-200 rounded">
                                                        Biaya: {{ number_format($method->fee_percentage, 1) }}%
                                                        @if($method->fee_fixed > 0)
                                                            + Rp {{ number_format($method->fee_fixed, 0, ',', '.') }}
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
                                                    @if($method->account_holder)
                                                        <p>Atas Nama: <span class="font-semibold">{{ $method->account_holder }}</span></p>
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
                            <div class="ui-card rounded-2xl border border-amber-500/40 p-4 text-xs text-amber-100">
                                Tidak ada metode pembayaran yang tersedia. Silakan hubungi admin.
                            </div>
                        @endforelse
                    </div>

                    @error('payment_method_id')
                        <p class="text-red-300 text-xs mb-3">{{ $message }}</p>
                    @enderror

                    <!-- Upload Bukti Transfer -->
                    <div class="mb-6 ui-card rounded-2xl p-5 ">
                        <h3 class="font-semibold text-gray-100 text-sm sm:text-base mb-3">Bukti Transfer</h3>
                        <p class="text-xs text-gray-400 mb-4">Upload screenshot atau foto bukti transfer Anda sebagai verifikasi pembayaran</p>
                        
                        <div class="space-y-4">
                            <!-- File Input -->
                            <div class="relative">
                                <input type="file" id="transfer_proof" name="transfer_proof" accept="image/*" 
                                    class="hidden transfer-proof-input"
                                    @error('transfer_proof') @enderror>
                                
                                <label for="transfer_proof" class="block cursor-pointer">
                                    <div class="border-2 border-dashed border-white/30 rounded-xl p-6 hover:border-amber-500/50 hover:bg-amber-500/5 transition-colors text-center">
                                        <div id="uploadPlaceholder" class="flex flex-col items-center justify-center">
                                            <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                                            <p class="text-sm text-gray-300 font-medium">Klik untuk upload atau drag & drop</p>
                                            <p class="text-xs text-gray-500 mt-1">JPG, PNG atau format gambar lainnya</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Preview Image -->
                            <div id="previewContainer" class="hidden">
                                <div class="relative bg-black/30 rounded-xl overflow-hidden  p-3">
                                    <img id="previewImage" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg">
                                    <button type="button" id="removeImage" 
                                        class="absolute top-5 right-5 bg-red-600 hover:bg-red-700 text-white rounded-full p-2 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <p id="fileName" class="mt-3 text-xs text-gray-400 truncate text-center"></p>
                                </div>
                            </div>
                        </div>

                        @error('transfer_proof')
                            <p class="text-red-300 text-xs mt-3">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('subscriptions.index') }}" 
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
// Transfer Proof Upload Preview
const transferProofInput = document.getElementById('transfer_proof');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');
const previewContainer = document.getElementById('previewContainer');
const previewImage = document.getElementById('previewImage');
const fileName = document.getElementById('fileName');
const removeImageBtn = document.getElementById('removeImage');

function handleFileSelect(file) {
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            fileName.textContent = file.name;
            uploadPlaceholder.classList.add('hidden');
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

transferProofInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) handleFileSelect(file);
});

// Drag & Drop
const dropZone = document.querySelector('.border-dashed');
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropZone.classList.add('border-amber-500/50', 'bg-amber-500/5');
}

function unhighlight(e) {
    dropZone.classList.remove('border-amber-500/50', 'bg-amber-500/5');
}

dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    if (files.length > 0) {
        transferProofInput.files = files;
        handleFileSelect(files[0]);
    }
}

// Remove Image
removeImageBtn.addEventListener('click', function(e) {
    e.preventDefault();
    transferProofInput.value = '';
    previewContainer.classList.add('hidden');
    uploadPlaceholder.classList.remove('hidden');
});

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
