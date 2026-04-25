@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-white-900 mb-6">Tambah Kategori</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST" class="ui-card p-6">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-white-700 mb-2">Nama Kategori *</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-white-700 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-[#FF2D20] text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                Simpan
            </button>
            <a href="{{ route('admin.categories.index') }}" class="bg-white-200 text-white-700 px-6 py-2 rounded-lg hover:bg-white-300 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
