@extends('layouts.admin')

@section('title', 'Langganan Baru')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.subscriptions.index') }}" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">Buat Langganan Baru</h1>
</div>

@if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="ui-card p-6">
    <form action="{{ route('admin.subscriptions.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label for="user_id" class="block text-sm font-medium text-white-700">Pengguna</label>
            <select name="user_id" id="user_id" class="mt-1 w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('user_id') border-red-500 @enderror" required>
                <option value="">-- Pilih Pengguna --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="plan" class="block text-sm font-medium text-white-700">Paket</label>
                <select name="plan" id="plan" class="mt-1 w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('plan') border-red-500 @enderror" required>
                    <option value="">-- Pilih Paket --</option>
                    <option value="monthly" {{ old('plan') == 'monthly' ? 'selected' : '' }}>Bulanan</option>
                    <option value="yearly" {{ old('plan') == 'yearly' ? 'selected' : '' }}>Tahunan</option>
                </select>
                @error('plan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-white-700">Harga</label>
                <input type="number" name="amount" id="amount" min="0" step="0.01" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('amount') border-red-500 @enderror"
                    value="{{ old('amount') }}" required>
                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="started_at" class="block text-sm font-medium text-white-700">Mulai</label>
                <input type="date" name="started_at" id="started_at" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('started_at') border-red-500 @enderror"
                    value="{{ old('started_at') }}" required>
                @error('started_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="expires_at" class="block text-sm font-medium text-white-700">Berakhir</label>
                <input type="date" name="expires_at" id="expires_at" 
                    class="mt-1 w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('expires_at') border-red-500 @enderror"
                    value="{{ old('expires_at') }}" required>
                @error('expires_at')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-white-700">Status</label>
            <select name="status" id="status" class="mt-1 w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20] @error('status') border-red-500 @enderror" required>
                <option value="">-- Pilih Status --</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Tertunda</option>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Berakhir</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-[#FF2D20] text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                Buat Langganan
            </button>
            <a href="{{ route('admin.subscriptions.index') }}" class="bg-white-300 text-white-700 px-6 py-2 rounded-lg hover:bg-white-400 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
