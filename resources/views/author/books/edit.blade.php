@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4 text-white">Edit Buku</h1>
    <div class="ui-card rounded-3xl  shadow-xl p-6">
        <form action="{{ route('author.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Judul Buku *</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" required
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('title')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Penulis *</label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" required
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('author')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">ISBN</label>
                    <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('isbn')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Tahun Terbit</label>
                    <input type="number" name="published_year" value="{{ old('published_year', $book->published_year) }}"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('published_year')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Penerbit</label>
                    <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('publisher')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Bahasa</label>
                    <select name="language"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                        <option value="id" {{ old('language', $book->language) == 'id' ? 'selected' : '' }}>Indonesia</option>
                        <option value="en" {{ old('language', $book->language) == 'en' ? 'selected' : '' }}>English</option>
                        <option value="ms" {{ old('language', $book->language) == 'ms' ? 'selected' : '' }}>Malay</option>
                    </select>
                    @error('language')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Total Halaman</label>
                    <input type="number" name="total_pages" value="{{ old('total_pages', $book->total_pages) }}"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('total_pages')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Halaman Gratis</label>
                    <input type="number" name="free_pages" value="{{ old('free_pages', $book->free_pages ?? 10) }}"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('free_pages')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">{{ old('description', $book->description) }}</textarea>
                    @error('description')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Kategori</label>
                    <select name="categories[]" multiple
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Cover (JPEG, PNG, JPG, GIF)</label>
                    @if($book->cover_url)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $book->cover_url) }}" alt="Cover saat ini" class="w-32 h-44 object-cover rounded-lg ">
                            <p class="text-xs text-gray-400 mt-2">Cover saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="cover" accept="image/*"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('cover')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $book->price ?? 0) }}"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('price')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">File Buku (PDF/EPUB)</label>
                    @if($book->file_path)
                        <p class="text-xs text-gray-400 mb-2">File saat ini: <strong>{{ basename($book->file_path) }}</strong></p>
                    @endif
                    <input type="file" name="file" accept=".pdf,.epub"
                        class="w-full rounded-2xl bg-white/5  text-gray-200 px-4 py-3 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20">
                    @error('file')<div class="text-red-400 text-sm mt-2">{{ $message }}</div>@enderror
                </div>

                <div class="md:col-span-2 flex flex-wrap gap-3 items-center">
                    <label class="flex items-center gap-2 text-gray-300">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $book->is_featured) ? 'checked' : '' }} class="rounded border-white/20 text-amber-500 focus:ring-amber-500">
                        Featured
                    </label>
                    <label class="flex items-center gap-2 text-gray-300">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $book->is_published) ? 'checked' : '' }} class="rounded border-white/20 text-amber-500 focus:ring-amber-500">
                        Published
                    </label>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-amber-600 text-slate-900 font-semibold hover:bg-amber-500 transition">Simpan</button>
                <a href="{{ route('author.books.index') }}" class="inline-flex items-center justify-center px-5 py-3 rounded-full bg-white/10 text-gray-200  hover:bg-white/15 transition">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection