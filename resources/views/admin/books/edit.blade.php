@extends('layouts.admin')

@section('title', 'Edit Buku')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="ui-card rounded-[28px] border border-white/10 p-8 shadow-2xl">
        <div class="flex flex-col gap-2">
            <h1 class="text-3xl font-semibold text-white">Edit Buku</h1>
            <p class="text-sm text-gray-400">Perbarui informasi buku ini. Hanya buku yang dipilih admin dapat diedit di halaman ini.</p>
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

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="ui-card rounded-[32px] border border-white/10 p-8 shadow-2xl">
        @csrf
        @method('PUT')
        <div class="grid gap-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul *</label>
                <input type="text" name="title" id="title" required
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('title', $book->title) }}">
                @error('title')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="author" class="block text-sm font-medium text-gray-300 mb-2">Penulis *</label>
                <input type="text" name="author" id="author" required
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('author', $book->author) }}">
                @error('author')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="isbn" class="block text-sm font-medium text-gray-300 mb-2">ISBN</label>
                <input type="text" name="isbn" id="isbn"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('isbn', $book->isbn) }}">
                @error('isbn')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="published_year" class="block text-sm font-medium text-gray-300 mb-2">Tahun Terbit</label>
                <input type="number" name="published_year" id="published_year"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('published_year', $book->published_year) }}">
                @error('published_year')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-300 mb-2">Penerbit</label>
                <input type="text" name="publisher" id="publisher"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('publisher', $book->publisher) }}">
                @error('publisher')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="total_pages" class="block text-sm font-medium text-gray-300 mb-2">Total Halaman</label>
                <input type="number" name="total_pages" id="total_pages"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('total_pages', $book->total_pages) }}">
                @error('total_pages')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="library_total_copies" class="block text-sm font-medium text-gray-300 mb-2">Jumlah Buku Fisik di Perpustakaan</label>
                <input type="number" name="library_total_copies" id="library_total_copies"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('library_total_copies', $book->library_total_copies ?? 0) }}">
                @error('library_total_copies')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="free_pages" class="block text-sm font-medium text-gray-300 mb-2">Halaman Gratis</label>
                <input type="number" name="free_pages" id="free_pages"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('free_pages', $book->free_pages ?? 10) }}">
                @error('free_pages')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Harga (Rp)</label>
                <input type="number" name="price" id="price" step="0.01"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400"
                    value="{{ old('price', $book->price ?? 0) }}">
                @error('price')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="language" class="block text-sm font-medium text-gray-300 mb-2">Bahasa</label>
                <select name="language" id="language"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                    <option value="">-- Pilih Bahasa --</option>
                    <option value="id" {{ old('language', $book->language) == 'id' ? 'selected' : '' }}>Indonesia</option>
                    <option value="en" {{ old('language', $book->language) == 'en' ? 'selected' : '' }}>English</option>
                    <option value="ms" {{ old('language', $book->language) == 'ms' ? 'selected' : '' }}>Malay</option>
                </select>
                @error('language')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="categories" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                <select name="categories[]" id="categories" multiple
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('categories') ? (in_array($category->id, old('categories', [])) ? 'selected' : '') : ($book->categories->contains($category->id) ? 'selected' : '') }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('categories')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="cover" class="block text-sm font-medium text-gray-300 mb-2">Cover (Max: 2MB, Format: JPEG/PNG)</label>
                @if($book->cover_url)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $book->cover_url) }}" alt="Current cover" class="w-32 h-48 rounded-3xl object-cover border border-white/10">
                        <p class="text-xs text-gray-500 mt-2">Cover saat ini</p>
                    </div>
                @endif
                <input type="file" name="cover" id="cover" accept="image/*"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                @error('cover')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-300 mb-2">File Buku (Max: 10MB, Format: PDF/EPUB)</label>
                @if($book->file_path)
                    <p class="text-xs text-gray-400 mb-2">File saat ini: <strong>{{ basename($book->file_path) }}</strong></p>
                @endif
                <input type="file" name="file" id="file" accept=".pdf,.epub"
                    class="w-full rounded-3xl bg-white/5 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                @error('file')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex flex-wrap gap-4 items-center">
                <label class="inline-flex items-center gap-2 text-gray-300">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $book->is_featured) ? 'checked' : '' }} class="h-4 w-4 rounded border-white/10 bg-white/5 text-amber-400 focus:ring-amber-400">
                    Featured
                </label>
                <label class="inline-flex items-center gap-2 text-gray-300">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $book->is_published) ? 'checked' : '' }} class="h-4 w-4 rounded border-white/10 bg-white/5 text-amber-400 focus:ring-amber-400">
                    Published
                </label>
            </div>
        </div>

        <div class="mt-8 flex flex-wrap gap-4">
            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-amber-400 px-6 py-3 text-sm font-semibold text-black hover:bg-amber-300 transition">Simpan Perubahan</button>
            <a href="{{ route('admin.books.index') }}" class="inline-flex items-center justify-center rounded-full border border-white/10 px-6 py-3 text-sm text-gray-300 hover:bg-white/5 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
