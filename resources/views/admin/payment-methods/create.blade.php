@extends('layouts.admin')

@section('title', 'Tambah Metode Pembayaran')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.payment-methods.index') }}" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">Tambah Metode Pembayaran</h1>
</div>

<div class="max-w-2xl">
    <div class="ui-card p-6">
        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Metode *</label>
                <input type="text" id="name" name="name" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                    value="{{ old('name') }}"
                    placeholder="contoh: BCA Transfer, OVO, Dana">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Metode *</label>
                <select id="type" name="type" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="bank" @if(old('type') === 'bank') selected @endif>Transfer Bank</option>
                    <option value="e-wallet" @if(old('type') === 'e-wallet') selected @endif>E-Wallet</option>
                    <option value="qris" @if(old('type') === 'qris') selected @endif>Qris</option>
                    <option value="other" @if(old('type') === 'other') selected @endif>Lainnya</option>
                </select>
                @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="description" name="description" rows="2" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                    placeholder="Deskripsi metode pembayaran (opsional)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">No. Rekening / Akun</label>
                    <input type="text" id="account_number" name="account_number" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="{{ old('account_number') }}"
                        placeholder="contoh: 1234567890">
                    @error('account_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="account_holder" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Akun</label>
                    <input type="text" id="account_holder" name="account_holder" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="{{ old('account_holder') }}"
                        placeholder="Nama pemilik">
                    @error('account_holder')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="fee_percentage" class="block text-sm font-medium text-gray-700 mb-1">Biaya (%)</label>
                    <input type="number" id="fee_percentage" name="fee_percentage" step="0.01" min="0" max="100"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="{{ old('fee_percentage', 0) }}">
                    @error('fee_percentage')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fee_fixed" class="block text-sm font-medium text-gray-700 mb-1">Biaya Tetap (Rp)</label>
                    <input type="number" id="fee_fixed" name="fee_fixed" step="0.01" min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="{{ old('fee_fixed', 0) }}">
                    @error('fee_fixed')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                        @if(old('is_active', true)) checked @endif
                        class="w-4 h-4 text-[#FF2D20] border-gray-300 rounded focus:ring-2 focus:ring-[#FF2D20]">
                    <span class="ml-2 text-sm font-medium text-gray-700">Aktifkan metode ini</span>
                </label>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.payment-methods.index') }}" class="flex-1 text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                    Simpan Metode Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
