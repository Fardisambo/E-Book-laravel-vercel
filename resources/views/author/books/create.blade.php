@extends('layouts.app')

@section('title', 'Upload Buku Baru')

@section('content')
<div class="min-h-screen bg-[#0f0f0f] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-white">Upload Buku Baru</h1>
            <p class="mt-2 text-sm text-gray-400">Tambahkan buku baru ke koleksi Anda. Isi semua detail agar buku Anda mudah ditemukan.</p>
        </div>

        <div class="ui-card rounded-[32px]  p-8 shadow-2xl">
            <form action="{{ route('author.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Judul Buku *</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('title')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Penulis *</label>
                        <input type="text" name="author" value="{{ old('author') }}" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('author')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">ISBN</label>
                        <input type="text" name="isbn" value="{{ old('isbn') }}"
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('isbn')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Tahun Terbit</label>
                        <input type="number" name="published_year" value="{{ old('published_year') }}"
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('published_year')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Penerbit</label>
                        <input type="text" name="publisher" value="{{ old('publisher') }}"
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('publisher')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Bahasa</label>
                        <select name="language"
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                            <option value="" disabled>-- Pilih Bahasa --</option>
                            <option value="id" {{ old('language') == 'id' ? 'selected' : '' }}>Indonesia</option>
                            <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="ms" {{ old('language') == 'ms' ? 'selected' : '' }}>Malay</option>
                        </select>
                        @error('language')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Total Halaman *</label>
                        <input type="number" name="total_pages" value="{{ old('total_pages') }}" min="1" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('total_pages')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Halaman Gratis</label>
                        <input type="number" name="free_pages" value="{{ old('free_pages', 10) }}" min="0"
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('free_pages')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Harga (Rp) *</label>
                        <input type="number" name="price" step="0.01" value="{{ old('price', 0) }}" min="0" required
                            class="w-full rounded-2xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @error('price')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full rounded-3xl bg-white/5  px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('description') }}</textarea>
                    @error('description')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                    <select name="categories[]" multiple class="w-full rounded-3xl bg-white/5  px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" class="bg-[#070707] text-white" {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Cover (JPEG/PNG/JPG/GIF)</label>
                        <input type="file" name="cover" accept="image/*" class="w-full rounded-3xl bg-white/5  px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400" />
                        @error('cover')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">File Buku (PDF/EPUB) *</label>
                        <input type="file" name="file" accept=".pdf,.epub" required class="w-full rounded-3xl bg-white/5  px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400" />
                        @error('file')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 items-center">
                    <label class="inline-flex items-center gap-2 text-gray-300">
                        <input type="checkbox" name="is_featured" value="1" class="h-4 w-4 rounded border-white/20 bg-white/10 text-amber-400 focus:ring-amber-400" {{ old('is_featured') ? 'checked' : '' }}>
                        Featured
                    </label>
                    <label class="inline-flex items-center gap-2 text-gray-300">
                        <input type="checkbox" name="is_published" value="1" class="h-4 w-4 rounded border-white/20 bg-white/10 text-amber-400 focus:ring-amber-400" {{ old('is_published', true) ? 'checked' : '' }}>
                        Published
                    </label>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button type="submit" class="rounded-full bg-amber-300 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-amber-200 transition">Simpan Buku</button>
                    <a href="{{ route('author.books.index') }}" class="rounded-full  px-6 py-3 text-sm text-gray-300 hover:bg-white/5 transition">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
