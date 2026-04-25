@extends('layouts.admin')

@section('title', 'Tambah Buku')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="ui-card rounded-[28px] border border-white/10 p-5 sm:p-8 shadow-2xl">
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl sm:text-3xl font-semibold text-white">Tambah Buku</h1>
            <p class="text-sm text-gray-400">Tambahkan buku baru ke koleksi admin. Isi semua informasi dan unggah file untuk buku ini.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="ui-card rounded-[28px] border border-red-500/20 bg-red-500/10 p-5 text-sm text-red-100">
            <div class="font-semibold mb-2">Terjadi kesalahan:</div>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="ui-card rounded-[32px] border border-white/10 p-5 sm:p-8 shadow-2xl">
        @csrf
        <div class="grid gap-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul *</label>
                <input type="text" name="title" id="title" required
                    class="ui-input"
                    value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="author" class="block text-sm font-medium text-gray-300 mb-2">Penulis *</label>
                <input type="text" name="author" id="author" required
                    class="ui-input"
                    value="{{ old('author') }}">
                @error('author')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-300 mb-2">ISBN</label>
                <input type="text" name="isbn" id="isbn"
                    class="ui-input"
                    value="{{ old('isbn') }}">
                @error('isbn')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="published_year" class="block text-sm font-medium text-gray-300 mb-2">Tahun Terbit</label>
                <input type="number" name="published_year" id="published_year"
                    class="ui-input"
                    value="{{ old('published_year') }}">
                @error('published_year')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-300 mb-2">Penerbit</label>
                <input type="text" name="publisher" id="publisher"
                    class="ui-input"
                    value="{{ old('publisher') }}">
                @error('publisher')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="total_pages" class="block text-sm font-medium text-gray-300 mb-2">Total Halaman</label>
                <input type="number" name="total_pages" id="total_pages"
                    class="ui-input"
                    value="{{ old('total_pages') }}">
                @error('total_pages')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="library_total_copies" class="block text-sm font-medium text-gray-300 mb-2">Jumlah Buku Fisik di Perpustakaan</label>
                <input type="number" name="library_total_copies" id="library_total_copies"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('library_total_copies', 0) }}">
                @error('library_total_copies')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="free_pages" class="block text-sm font-medium text-gray-300 mb-2">Halaman Gratis</label>
                <input type="number" name="free_pages" id="free_pages" value="{{ old('free_pages', 10) }}"
                    class="ui-input">
                @error('free_pages')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Harga (Rp)</label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price', 0) }}"
                    class="ui-input">
                @error('price')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="language" class="block text-sm font-medium text-gray-300 mb-2">Bahasa</label>
                <select name="language" id="language"
                    class="ui-select">
                    <option value="">-- Pilih Bahasa --</option>
                    <option value="id" {{ old('language') == 'id' ? 'selected' : '' }}>Indonesia</option>
                    <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ms" {{ old('language') == 'ms' ? 'selected' : '' }}>Malay</option>
                </select>
                @error('language')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="ui-textarea">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="categories" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                <select name="categories[]" id="categories" multiple
                    class="ui-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cover" class="block text-sm font-medium text-gray-300 mb-2">Cover (Max: 2MB, Format: JPEG/PNG)</label>
                <input type="file" name="cover" id="cover" accept="image/*"
                    class="ui-input">
                @error('cover')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-300 mb-2">File Buku (Max: 10MB, Format: PDF/EPUB) *</label>
                <input type="file" name="file" id="file" accept=".pdf,.epub"
                    class="ui-input">
                @error('file')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex flex-wrap gap-4 items-center">
                <label class="inline-flex items-center gap-2 text-gray-300">
                    <input type="checkbox" name="is_featured" value="1" class="h-4 w-4 rounded border-white/10 bg-white/5 text-amber-400 focus:ring-amber-400" {{ old('is_featured') ? 'checked' : '' }}>
                    Featured
                </label>
                <label class="inline-flex items-center gap-2 text-gray-300">
                    <input type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-white/10 bg-white/5 text-amber-400 focus:ring-amber-400" {{ old('is_published', true) ? 'checked' : '' }}>
                    Published
                </label>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-4">
            <button type="submit" class="ui-btn-primary">Simpan Buku</button>
            <a href="{{ route('admin.books.index') }}" class="ui-btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection
