@extends('layouts.admin')

@section('title', 'Edit Pesanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.purchases.index') }}" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">Edit Pesanan #{{ $purchase->id }}</h1>
</div>

<div class="max-w-2xl">
    <div class="ui-card p-6">
        <form action="{{ route('admin.purchases.update', $purchase->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Pembeli</label>
                <input type="text" value="{{ $purchase->user->name }} ({{ $purchase->user->email }})" readonly 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Buku</label>
                <input type="text" value="{{ $purchase->book->title }}" readonly 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-600">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" value="Rp {{ number_format($purchase->price, 0, ',', '.') }}" readonly 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-gray-600">
            </div>

            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
                    <option value="">-- Pilih Status --</option>
                    <option value="pending" @if($purchase->status === 'pending') selected @endif>Menunggu</option>
                    <option value="completed" @if($purchase->status === 'completed') selected @endif>Selesai</option>
                    <option value="failed" @if($purchase->status === 'failed') selected @endif>Gagal</option>
                    <option value="cancelled" @if($purchase->status === 'cancelled') selected @endif>Batal</option>
                </select>
                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.purchases.index') }}" class="flex-1 text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
