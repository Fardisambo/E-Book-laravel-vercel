@extends('layouts.app')

@section('title', 'Edit Metode Pembayaran')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Metode Pembayaran</h1>
    <div class="ui-card rounded-xl p-6 ">
        <form action="{{ route('author.payment-methods.update', $method->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">Nama Metode</label>
                <input type="text" name="name" class="form-input w-full bg-white/10  text-gray-200 rounded-lg" value="{{ old('name', $method->name) }}" required>
                @error('name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">No. Rekening/ID</label>
                <input type="text" name="account_number" class="form-input w-full bg-white/10  text-gray-200 rounded-lg" value="{{ old('account_number', $method->account_number) }}" required>
                @error('account_number')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">Atas Nama</label>
                <input type="text" name="account_name" class="form-input w-full bg-white/10  text-gray-200 rounded-lg" value="{{ old('account_name', $method->account_name) }}" required>
                @error('account_name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">Jenis (Bank/Ewallet)</label>
                <input type="text" name="type" class="form-input w-full bg-white/10  text-gray-200 rounded-lg" value="{{ old('type', $method->type) }}" required>
                @error('type')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-200">Status</label>
                <select name="is_active" class="form-input w-full bg-white/10  text-gray-200 rounded-lg">
                    <option value="1" @if($method->is_active) selected @endif>Aktif</option>
                    <option value="0" @if(!$method->is_active) selected @endif>Nonaktif</option>
                </select>
                @error('is_active')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div class="flex gap-2 mt-6">
                <button type="submit" class="px-4 py-2 rounded-lg bg-amber-600 text-white font-semibold hover:bg-amber-700 transition">Update</button>
                <a href="{{ route('author.payment-methods.index') }}" class="px-4 py-2 rounded-lg bg-gray-700 text-gray-200 font-semibold hover:bg-gray-800 transition">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
