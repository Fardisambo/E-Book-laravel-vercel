@extends('layouts.admin')

@section('title', 'Edit Metode Pembayaran')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.payment-methods.index') }}" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">Edit Metode Pembayaran: {{ $paymentMethod->name }}</h1>
</div>

<div class="max-w-2xl">
    <div class="ui-card p-6">
        <form action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Metode *</label>
                <input type="text" id="name" name="name" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                    value="{{ old('name', $paymentMethod->name) }}">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe Metode *</label>
                <select id="type" name="type" required 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">
                    @foreach($types as $type)
                        <option value="{{ $type }}" @if(old('type', $paymentMethod->type) === $type) selected @endif>
                            {{ ucfirst(str_replace('-', ' ', $type)) }}
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="description" name="description" rows="2" 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]">{{ old('description', $paymentMethod->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">No. Rekening / Akun</label>
                    <input type="text" id="account_number" name="account_number" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="{{ old('account_number', $paymentMethod->account_number) }}">
                    @error('account_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="account_holder" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Akun</label>
                    <input type="text" id="account_holder" name="account_holder" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="{{ old('account_holder', $paymentMethod->account_holder) }}">
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
                        value="{{ old('fee_percentage', $paymentMethod->fee_percentage) }}">
                    @error('fee_percentage')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="fee_fixed" class="block text-sm font-medium text-gray-700 mb-1">Biaya Tetap (Rp)</label>
                    <input type="number" id="fee_fixed" name="fee_fixed" step="0.01" min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]"
                        value="{{ old('fee_fixed', $paymentMethod->fee_fixed) }}">
                    @error('fee_fixed')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                        @if(old('is_active', $paymentMethod->is_active)) checked @endif
                        class="w-4 h-4 text-[#FF2D20] border-gray-300 rounded focus:ring-2 focus:ring-[#FF2D20]">
                    <span class="ml-2 text-sm font-medium text-gray-700">Aktifkan metode ini</span>
                </label>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.payment-methods.index') }}" class="flex-1 text-center border border-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-50 transition-colors">
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
