@extends('layouts.app')

@section('title', 'Jelajahi Semua Buku')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Filter Sidebar -->
    <aside class="hidden lg:block lg:col-span-1">
        <div class="sticky top-20 space-y-4">
            <h3 class="font-serif text-xl text-white">Filter</h3>
            
            <form method="GET" action="{{ route('books.browse') }}" class="space-y-4">
                <!-- Category Filter -->
                <div class="ui-card rounded-xl p-4 ">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Kategori</label>
                    <select name="category" class="ui-select"
                        onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Type Filter -->
                <div class="ui-card rounded-xl p-4 ">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Jenis Harga</label>
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="price_type" value="" class="w-4 h-4 cursor-pointer" 
                                {{ !request('price_type') ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="text-sm text-gray-300">Semua</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="price_type" value="free" class="w-4 h-4 cursor-pointer"
                                {{ request('price_type') == 'free' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="text-sm text-gray-300">Gratis</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="price_type" value="paid" class="w-4 h-4 cursor-pointer"
                                {{ request('price_type') == 'paid' ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="text-sm text-gray-300">Berbayar</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="ui-card rounded-xl p-4 ">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Rentang Harga</label>
                    <div class="space-y-2">
                        <input type="number" name="price_min" placeholder="Harga Min (Rp)" 
                            value="{{ request('price_min') }}"
                            class="ui-input">
                        <input type="number" name="price_max" placeholder="Harga Max (Rp)"
                            value="{{ request('price_max') }}"
                            class="ui-input">
                        <button type="submit" class="w-full mt-2 px-3 py-2 ui-btn-primary">
                            Terapkan
                        </button>
                    </div>
                </div>

                <!-- Publisher Filter -->
                <div class="ui-card rounded-xl p-4 ">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Penerbit</label>
                    <input type="text" name="publisher" placeholder="Cari penerbit..."
                        value="{{ request('publisher') }}"
                        class="ui-input">
                    <button type="submit" class="w-full mt-2 px-3 py-2 ui-btn-primary">
                        Cari
                    </button>
                </div>

                <!-- Page Count Filter -->
                <div class="ui-card rounded-xl p-4 ">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Jumlah Halaman</label>
                    <div class="space-y-2">
                        <input type="number" name="min_pages" placeholder="Min Halaman"
                            value="{{ request('min_pages') }}"
                            class="ui-input">
                        <input type="number" name="max_pages" placeholder="Max Halaman"
                            value="{{ request('max_pages') }}"
                            class="ui-input">
                        <button type="submit" class="w-full mt-2 px-3 py-2 ui-btn-primary">
                            Terapkan
                        </button>
                    </div>
                </div>

                <!-- Preview Filter -->
                <div class="ui-card rounded-xl p-4 ">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="has_preview" value="1" class="w-4 h-4 cursor-pointer"
                            {{ request('has_preview') ? 'checked' : '' }} onchange="this.form.submit()">
                        <span class="text-sm text-gray-300">Hanya buku dengan preview</span>
                    </label>
                </div>

                <!-- Sort Filter -->
                <div class="ui-card rounded-xl p-4 ">
                    <label class="block text-sm font-medium text-gray-200 mb-3">Urutkan</label>
                    <select name="sort_by" class="ui-select mb-2"
                        onchange="this.form.submit()">
                        <option value="created_at" {{ request('sort_by', 'created_at') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                        <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Judul (A-Z)</option>
                        <option value="views" {{ request('sort_by') == 'views' ? 'selected' : '' }}>Paling Dikunjungi</option>
                        <option value="downloads" {{ request('sort_by') == 'downloads' ? 'selected' : '' }}>Paling Diunduh</option>
                        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                    </select>
                    <select name="sort_order" class="ui-select"
                        onchange="this.form.submit()">
                        <option value="desc" {{ request('sort_order', 'desc') == 'desc' ? 'selected' : '' }}>Menurun</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Meningkat</option>
                    </select>
                </div>

                <!-- Clear Filters -->
                @if(request()->anyFilled(['category', 'price_type', 'price_min', 'price_max', 'publisher', 'min_pages', 'max_pages', 'has_preview']))
                    <a href="{{ route('books.browse') }}" class="block w-full px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-300 text-sm font-medium rounded-lg text-center border border-red-500/30 transition-colors">
                        Hapus Semua Filter
                    </a>
                @endif
            </form>
        </div>
    </aside>

    <!-- Books Grid -->
    <div class="lg:col-span-3">
        <div class="space-y-4">
            <details class="lg:hidden ui-card rounded-2xl p-4">
                <summary class="list-none cursor-pointer flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-white">Filter Buku</h3>
                        <p class="text-xs text-gray-400">Buka filter lanjutan tanpa menutupi daftar buku.</p>
                    </div>
                    <span class="ui-btn-ghost text-xs px-3 py-2">
                        <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>
                        Filter
                    </span>
                </summary>

                <form method="GET" action="{{ route('books.browse') }}" class="mt-4 space-y-3">
                    <div class="grid grid-cols-1 gap-3">
                        <select name="category" class="ui-select" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="price_min" placeholder="Harga Min" value="{{ request('price_min') }}" class="ui-input">
                            <input type="number" name="price_max" placeholder="Harga Max" value="{{ request('price_max') }}" class="ui-input">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="min_pages" placeholder="Min Halaman" value="{{ request('min_pages') }}" class="ui-input">
                            <input type="number" name="max_pages" placeholder="Max Halaman" value="{{ request('max_pages') }}" class="ui-input">
                        </div>

                        <input type="text" name="publisher" placeholder="Cari penerbit..." value="{{ request('publisher') }}" class="ui-input">

                        <div class="grid grid-cols-2 gap-2">
                            <select name="price_type" class="ui-select" onchange="this.form.submit()">
                                <option value="" {{ !request('price_type') ? 'selected' : '' }}>Semua Harga</option>
                                <option value="free" {{ request('price_type') == 'free' ? 'selected' : '' }}>Gratis</option>
                                <option value="paid" {{ request('price_type') == 'paid' ? 'selected' : '' }}>Berbayar</option>
                            </select>
                            <select name="sort_by" class="ui-select" onchange="this.form.submit()">
                                <option value="created_at" {{ request('sort_by', 'created_at') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                                <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Judul</option>
                                <option value="views" {{ request('sort_by') == 'views' ? 'selected' : '' }}>View</option>
                                <option value="downloads" {{ request('sort_by') == 'downloads' ? 'selected' : '' }}>Download</option>
                                <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                            </select>
                        </div>

                        <select name="sort_order" class="ui-select" onchange="this.form.submit()">
                            <option value="desc" {{ request('sort_order', 'desc') == 'desc' ? 'selected' : '' }}>Urutan Menurun</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Urutan Meningkat</option>
                        </select>

                        <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-300">
                            <input type="checkbox" name="has_preview" value="1" class="w-4 h-4 cursor-pointer" {{ request('has_preview') ? 'checked' : '' }}>
                            Hanya buku dengan preview
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <button type="submit" class="ui-btn-primary w-full">Terapkan</button>
                        @if(request()->anyFilled(['category', 'price_type', 'price_min', 'price_max', 'publisher', 'min_pages', 'max_pages', 'has_preview']))
                            <a href="{{ route('books.browse') }}" class="ui-btn-ghost w-full">Reset</a>
                        @endif
                    </div>
                </form>
            </details>

            <div class="flex items-center justify-between">
                <h2 class="font-serif text-2xl text-white">Jelajahi Perpustakaan</h2>
                <span class="text-sm text-gray-400">{{ $books->total() }} buku ditemukan</span>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3">
                @forelse($books as $book)
                    <div class="book-card ui-card rounded-2xl  overflow-hidden cursor-pointer">
                        <a href="{{ route('books.show', $book->id) }}">
                            <div class="relative h-52 sm:h-60 overflow-hidden">
                                <img
                                    src="{{ $book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/400x225?text=No+Cover' }}"
                                    alt="Cover {{ $book->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                >
                                @if(!$book->isFree())
                                    <div class="absolute top-3 left-3 px-2 py-1 rounded-full bg-black/70  text-[11px] text-amber-200">
                                        Rp {{ number_format($book->price, 0, ',', '.') }}
                                    </div>
                                @else
                                    <div class="absolute top-3 left-3 px-2 py-1 rounded-full bg-emerald-500/80 text-[11px] text-black font-semibold">
                                        Gratis
                                    </div>
                                @endif
                                @if($book->free_pages > 0)
                                    <div class="absolute bottom-3 right-3 px-2 py-1 rounded-full bg-blue-500/80 text-[11px] text-white font-semibold">
                                        Preview
                                    </div>
                                @endif
                            </div>
                        </a>
                        <div class="p-4 space-y-2">
                            <h3 class="font-medium text-sm sm:text-base text-white line-clamp-2">
                                <a href="{{ route('books.show', $book->id) }}" class="hover:text-amber-300">
                                    {{ $book->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-gray-400">
                                Oleh {{ $book->author }}
                            </p>
                            @if($book->publisher)
                                <p class="text-xs text-gray-500">
                                    {{ $book->publisher }}
                                </p>
                            @endif
                            <div class="flex items-center justify-between text-[11px] text-gray-500">
                                <span class="flex items-center gap-1">
                                    <i data-lucide="eye" class="w-3 h-3"></i>
                                    {{ number_format($book->views) }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <i data-lucide="download" class="w-3 h-3"></i>
                                    {{ number_format($book->downloads) }}
                                </span>
                            </div>
                            @if($book->total_pages)
                                <p class="text-xs text-gray-500">
                                    {{ $book->total_pages }} halaman
                                </p>
                            @endif
                            <a href="{{ route('books.show', $book->id) }}"
                               class="mt-2 block w-full text-center px-3 py-2 rounded-full ui-btn-ghost text-xs">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full ui-card rounded-2xl p-10 text-center text-gray-400">
                        <i data-lucide="search" class="w-12 h-12 mx-auto mb-4 text-gray-500"></i>
                        <p class="text-lg">Tidak ada buku yang sesuai dengan filter Anda.</p>
                        <a href="{{ route('books.browse') }}" class="text-amber-300 hover:text-amber-200 mt-4 inline-block text-sm">
                            Hapus filter
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
