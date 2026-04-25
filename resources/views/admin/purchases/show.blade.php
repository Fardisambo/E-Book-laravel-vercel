@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.purchases.index') }}" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">Detail Pesanan #{{ $purchase->id }}</h1>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Informasi Pesanan -->
        <div class="ui-card p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Informasi Pesanan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-500">ID Pesanan</label>
                    <p class="text-lg text-white-900">{{ $purchase->id }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Status</label>
                    <p class="text-lg">
                        <span class="px-3 py-1 rounded-full font-semibold
                            @if($purchase->status === 'completed')
                                bg-green-100 text-green-800
                            @elseif($purchase->status === 'pending')
                                bg-yellow-100 text-yellow-800
                            @elseif($purchase->status === 'failed')
                                bg-red-100 text-red-800
                            @elseif($purchase->status === 'cancelled')
                                bg-gray-100 text-white-900
                            @endif
                        ">
                            {{ ucfirst($purchase->status) }}
                        </span>
                    </p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Tanggal Pesanan</label>
                    <p class="text-lg text-white-900">{{ $purchase->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500">Harga</label>
                    <p class="text-lg font-bold text-white-900">Rp {{ number_format($purchase->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Detail Pembeli dan Buku -->
        <div class="ui-card p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Detail Pembeli & Buku</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-white-900 mb-3">Data Pembeli</h3>
                    <p><strong>Nama:</strong> {{ $purchase->user->name }}</p>
                    <p><strong>Email:</strong> {{ $purchase->user->email }}</p>
                    <p><strong>Role:</strong> {{ $purchase->user->role }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-white-900 mb-3">Data Buku</h3>
                    <p><strong>Judul:</strong> {{ $purchase->book->title }}</p>
                    <p><strong>Penulis:</strong> {{ $purchase->book->author ?? '-' }}</p>
                    <p><strong>Tahun Publikasi:</strong> {{ $purchase->book->publication_year ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="ui-card p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-white-900">Pembayaran</h2>
                <button type="button" onclick="document.getElementById('addPaymentModal').classList.toggle('hidden')" 
                    class="bg-[#FF2D20] text-white px-3 py-1 rounded hover:bg-red-600 transition-colors text-sm">
                    + Tambah Pembayaran
                </button>
            </div>

            @if($purchase->payments->count() > 0)
                <div class="space-y-3">
                    @foreach($purchase->payments as $payment)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-white-900">{{ $payment->method }}</p>
                                <p class="text-sm text-gray-500">
                                    ID Transaksi: {{ $payment->transaction_id ?? '-' }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $payment->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-lg text-white-900">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </p>
                                <span class="text-xs px-2 py-1 rounded
                                    @if($payment->status === 'completed')
                                        bg-green-100 text-green-800
                                    @elseif($payment->status === 'pending')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </div>
                        </div>
                        
                        @if($payment->notes)
                        <p class="text-sm text-gray-600 mt-2"><strong>Catatan:</strong> {{ $payment->notes }}</p>
                        @endif

                        @if($payment->transfer_proof)
                        <div class="mt-3 pt-3 border-t border-gray-200">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Bukti Transfer:</p>
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $payment->transfer_proof) }}" alt="Bukti Transfer" class="max-h-40 rounded border border-gray-200 cursor-pointer" onclick="openImageModal(this.src)">
                                <span class="text-xs text-gray-500 mt-1 block">Klik untuk memperbesar</span>
                            </div>
                        </div>
                        @endif

                        <div class="mt-3 flex gap-2">
                            <form action="{{ route('admin.purchases.updatePaymentStatus', $purchase->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-300 rounded px-2 py-1">
                                    <option value="">Ubah Status</option>
                                    <option value="completed" @if($payment->status === 'completed') selected @endif>Selesai</option>
                                    <option value="pending" @if($payment->status === 'pending') selected @endif>Menunggu</option>
                                    <option value="failed" @if($payment->status === 'failed') selected @endif>Gagal</option>
                                    <option value="cancelled" @if($payment->status === 'cancelled') selected @endif>Batal</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada pembayaran</p>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Actions -->
        <div class="ui-card p-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Aksi</h2>
            
            <div class="space-y-2">
                <a href="{{ route('admin.purchases.edit', $purchase->id) }}" 
                    class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                    Edit Pesanan
                </a>
                <button onclick="if(confirm('Yakin ingin menghapus pesanan ini?')) document.getElementById('deleteForm').submit()" 
                    class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                    Hapus Pesanan
                </button>
            </div>

            <form id="deleteForm" action="{{ route('admin.purchases.destroy', $purchase->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>

        <!-- Summary -->
        <div class="ui-card p-6 mt-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Ringkasan</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Harga Buku:</span>
                    <span class="font-semibold text-white-900">Rp {{ number_format($purchase->price, 0, ',', '.') }}</span>
                </div>
                @php
                    $totalPayments = $purchase->payments->sum('amount');
                    $completedPayments = $purchase->payments->where('status', 'completed')->sum('amount');
                    $remainingAmount = $purchase->price - $completedPayments;
                @endphp
                <div class="flex justify-between">
                    <span class="text-gray-600">Pembayaran Selesai:</span>
                    <span class="font-semibold text-green-600">Rp {{ number_format($completedPayments, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Semua Pembayaran:</span>
                    <span class="font-semibold text-white-900">Rp {{ number_format($totalPayments, 0, ',', '.') }}</span>
                </div>
                <div class="border-t border-gray-200 pt-3 flex justify-between">
                    <span class="text-white-900 font-bold">Sisa Pembayaran:</span>
                    <span class="font-bold @if($remainingAmount <= 0) text-green-600 @else text-red-600 @endif">
                        Rp {{ number_format(max(0, $remainingAmount), 0, ',', '.') }}
                    </span>
                </div>
                <div class="pt-2 border-t border-gray-200 mt-2">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status Pembayaran:</span>
                        <span class="px-2 py-1 rounded text-xs font-semibold @if($remainingAmount <= 0) bg-green-100 text-green-800 @else bg-yellow-100 text-yellow-800 @endif">
                            @if($remainingAmount <= 0)
                                Lunas
                            @elseif($totalPayments > 0)
                                Sebagian
                            @else
                                Belum Dibayar
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gambar Transfer Proof -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
    <div class="ui-card-lg p-4 max-w-2xl max-h-[90vh] overflow-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-white-900">Bukti Transfer</h3>
            <button onclick="document.getElementById('imageModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <img id="modalImage" src="" alt="Bukti Transfer" class="w-full rounded">
    </div>
</div>

<script>
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
    }
});
</script>

<!-- Modal Tambah Pembayaran -->
<div id="addPaymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="ui-card-lg p-6 w-96">
        <h3 class="text-xl font-bold text-white-900 mb-4">Tambah Pembayaran</h3>
        
        <form action="{{ route('admin.purchases.createPayment', $purchase->id) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                <input type="text" name="method" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Rp)</label>
                <input type="number" name="amount" step="0.01" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
            </div>

            <div class="flex gap-2">
                <button type="button" onclick="document.getElementById('addPaymentModal').classList.toggle('hidden')" 
                    class="flex-1 border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
