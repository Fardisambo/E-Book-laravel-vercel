@extends('layouts.admin')

@section('title', 'Edit Langganan')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.subscriptions.index') }}" class="text-[#FF2D20] hover:text-red-600 text-sm">← Kembali</a>
    <h1 class="text-2xl font-bold text-white-900 mt-1">Edit Langganan #{{ $subscription->id }}</h1>
</div>

@if ($errors->any())
    <div class="mb-3 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="ui-card p-4">
    <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pengguna --}}
        <div class="mb-3">
            <label for="user_id" class="block text-sm font-medium text-white-700">Pengguna</label>
            <select name="user_id" id="user_id" class="mt-1 w-full border border-white-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('user_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $subscription->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Paket & Harga --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-2">
            <div>
                <label for="plan" class="block text-xs font-medium text-white-700">Paket</label>
                <select name="plan" id="plan" class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('plan') border-red-500 @enderror" required>
                    <option value="">-- Paket --</option>
                    <option value="monthly" {{ old('plan', $subscription->plan) == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    <option value="yearly" {{ old('plan', $subscription->plan) == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                </select>
                @error('plan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="amount" class="block text-xs font-medium text-white-700">Harga</label>
                <input type="number" name="amount" id="amount" min="0" step="0.01" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('amount') border-red-500 @enderror"
                    value="{{ old('amount', $subscription->amount) }}" required>
                @error('amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Tanggal Mulai & Berakhir --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-2">
            <div>
                <label for="started_at" class="block text-xs font-medium text-white-700">Mulai</label>
                <input type="date" name="started_at" id="started_at" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('started_at') border-red-500 @enderror"
                    value="{{ old('started_at', $subscription->started_at?->format('Y-m-d')) }}" required>
                @error('started_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="expires_at" class="block text-xs font-medium text-white-700">Berakhir</label>
                <input type="date" name="expires_at" id="expires_at" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('expires_at') border-red-500 @enderror"
                    value="{{ old('expires_at', $subscription->expires_at?->format('Y-m-d')) }}" required>
                @error('expires_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-white-700">Status</label>
            <select name="status" id="status" class="mt-1 w-full border border-white-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('status') border-red-500 @enderror" required>
                <option value="">-- Pilih Status --</option>
                <option value="pending" {{ old('status', $subscription->status) == 'pending' ? 'selected' : '' }}>Tertunda</option>
                <option value="active" {{ old('status', $subscription->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="expired" {{ old('status', $subscription->status) == 'expired' ? 'selected' : '' }}>Berakhir</option>
                <option value="cancelled" {{ old('status', $subscription->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-sm">
                Simpan
            </button>
            <a href="{{ route('admin.subscriptions.index') }}" class="flex-1 bg-white-300 text-white-700 px-4 py-2 rounded-lg hover:bg-white-400 transition-colors text-sm text-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
