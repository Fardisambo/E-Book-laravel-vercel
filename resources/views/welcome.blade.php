@extends('layouts.app')

@section('title', 'Katalog Ebook')

@section('content')
@php
    $featuredBook = $popularBooks->first() ?? $newBooks->first() ?? $books->first();
@endphp

<div class="space-y-8">
    <!-- Hero Section -->
    @if($featuredBook)
        <section class="relative overflow-hidden rounded-3xl ui-card  p-6 sm:p-10">
            <div class="absolute top-0 right-0 w-64 h-64 sm:w-80 sm:h-80 bg-amber-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                <div class="flex-1 space-y-4">
                    <span class="inline-block px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-300 text-[11px] font-medium tracking-[0.2em] uppercase">
                        Buku Pilihan Untuk Anda
                    </span>
                    <h1 class="font-serif text-3xl sm:text-4xl font-semibold text-white leading-tight">
                        {{ $featuredBook->title }}
                    </h1>
                    <p class="text-sm text-gray-400">
                        Oleh <span class="text-amber-200">{{ $featuredBook->author }}</span>
                    </p>
                    <p class="text-gray-400 max-w-xl text-sm sm:text-base leading-relaxed">
                        {{ \Illuminate\Support\Str::limit($featuredBook->description ?? 'Temukan pengalaman membaca yang elegan dengan koleksi eksklusif kami.', 150) }}
                    </p>
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a href="{{ route('books.read', $featuredBook->id) }}"
                           class="px-5 py-2.5 bg-gradient-to-r from-amber-600 to-amber-500 text-black text-sm font-medium rounded-full hover:shadow-lg hover:shadow-amber-500/25 transition-all transform hover:scale-105 flex items-center gap-2">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                            Baca Sekarang
                        </a>
                        <a href="{{ route('books.show', $featuredBook->id) }}"
                           class="px-5 py-2.5 border border-white/15 text-sm text-gray-100 rounded-full hover:bg-white/5 transition-all flex items-center gap-2">
                            <i data-lucide="info" class="w-4 h-4"></i>
                            Detail Buku
                        </a>
                    </div>
                </div>
                <div class="relative w-36 sm:w-44 md:w-56 aspect-[2/3]">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-amber-600 rounded-lg transform rotate-6 opacity-20"></div>
                    <img
                        src="{{ $featuredBook->cover_url ? asset('storage/' . $featuredBook->cover_url) : 'https://placehold.co/400x600?text=No+Cover' }}"
                        alt="{{ $featuredBook->title }}"
                        class="relative w-full h-full object-cover rounded-lg shadow-2xl shadow-black/50 "
                    >
                    <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-black/80 backdrop-blur-xl rounded-2xl  flex items-center justify-center">
                        <div class="text-center">
                            <span class="block text-xs text-gray-500 uppercase tracking-[0.18em] mb-1">Dibaca</span>
                            <span class="block text-lg font-semibold text-amber-300">
                                {{ number_format($featuredBook->views) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Stats Row -->
    <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="ui-card rounded-2xl p-4 sm:p-5 ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-amber-500/10 flex items-center justify-center">
                    <i data-lucide="book" class="w-4 h-4 text-amber-400"></i>
                </div>
                <span class="text-[11px] text-gray-500">Total Buku</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white">{{ number_format($books->total() ?? $books->count()) }}</p>
            <p class="text-[11px] text-gray-500 mt-1">Dalam perpustakaan Anda</p>
        </div>

        <div class="ui-card rounded-2xl p-4 sm:p-5 ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-emerald-500/10 flex items-center justify-center">
                    <i data-lucide="clock" class="w-4 h-4 text-emerald-400"></i>
                </div>
                <span class="text-[11px] text-gray-500">Buku Baru</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white">{{ number_format($newBooks->count()) }}</p>
            <p class="text-[11px] text-gray-500 mt-1">1 minggu terakhir</p>
        </div>

        <div class="ui-card rounded-2xl p-4 sm:p-5 ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-purple-500/10 flex items-center justify-center">
                    <i data-lucide="flame" class="w-4 h-4 text-purple-400"></i>
                </div>
            <span class="text-[11px] text-gray-500">Populer</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white">{{ number_format($popularBooks->count()) }}</p>
            <p class="text-[11px] text-gray-500 mt-1">Sering dibaca</p>
        </div>

        <div class="ui-card rounded-2xl p-4 sm:p-5 ">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-full bg-rose-500/10 flex items-center justify-center">
                    <i data-lucide="heart" class="w-4 h-4 text-rose-400"></i>
                </div>
                <span class="text-[11px] text-gray-500">Koleksi</span>
            </div>
            <p class="text-2xl font-serif font-semibold text-white">{{ number_format($books->count()) }}</p>
            <p class="text-[11px] text-gray-500 mt-1">Siap dinikmati</p>
        </div>
    </section>

    <!-- Buku Baru & Populer -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            @if($newBooks->count() > 0)
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-serif text-xl text-white">Buku Baru Minggu Ini</h2>
                        <a href="{{ route('books.browse') }}" class="text-xs text-amber-300 hover:text-amber-200 flex items-center gap-1">
                            Lihat Semua
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($newBooks as $book)
                            <a href="{{ route('books.show', $book->id) }}" class="group">
                                <div class="book-card ui-card rounded-2xl p-3  cursor-pointer">
                                    <div class="relative aspect-[2/3] mb-3 overflow-hidden rounded-xl">
                                        <img
                                            src="{{ $book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/200x300?text=No+Cover' }}"
                                            alt="{{ $book->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    <h3 class="font-medium text-xs sm:text-sm text-white mb-1 line-clamp-2 group-hover:text-amber-300 transition-colors">
                                        {{ $book->title }}
                                    </h3>
                                    <p class="text-[11px] text-gray-500">
                                        {{ $book->author }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($popularBooks->count() > 0)
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-serif text-xl text-white">Buku Populer</h2>
                        <a href="{{ route('books.browse') }}" class="text-xs text-amber-300 hover:text-amber-200 flex items-center gap-1">
                            Lihat Semua
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($popularBooks as $book)
                            <a href="{{ route('books.show', $book->id) }}" class="group">
                                <div class="book-card ui-card rounded-2xl p-3  cursor-pointer">
                                    <div class="relative aspect-[2/3] mb-3 overflow-hidden rounded-xl">
                                        <img
                                            src="{{ $book->cover_url ? asset('storage/' . $book->cover_url) : 'https://placehold.co/200x300?text=No+Cover' }}"
                                            alt="{{ $book->title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        >
                                        <div class="absolute top-2 right-2 bg-amber-500 text-black text-[10px] font-semibold px-2 py-1 rounded-full flex items-center gap-1">
                                            <i data-lucide="flame" class="w-3 h-3"></i>
                                            {{ number_format($book->views) }}
                                        </div>
                                    </div>
                                    <h3 class="font-medium text-xs sm:text-sm text-white mb-1 line-clamp-2 group-hover:text-amber-300 transition-colors">
                                        {{ $book->title }}
                                    </h3>
                                    <p class="text-[11px] text-gray-500 mb-1">
                                        {{ $book->author }}
                                    </p>
                                    <p class="text-[11px] text-gray-500 flex items-center gap-2">
                                        <span><i data-lucide="eye" class="inline w-3 h-3 mr-1"></i>{{ number_format($book->views) }}</span>
                                        <span><i data-lucide="download" class="inline w-3 h-3 mr-1"></i>{{ number_format($book->downloads) }}</span>
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Filter / Ringkasan -->
        <aside class="space-y-4">
            <div class="ui-card rounded-2xl p-5 ">
                <h3 class="font-serif text-lg text-white mb-4">Pilih Kategori</h3>
                <form action="{{ route('books.index') }}" method="GET" class="space-y-2">
                    <select name="category" class="w-full bg-black/30  rounded-lg px-3 py-2 text-sm text-gray-300 focus:outline-none focus:border-amber-500/50 appearance-none cursor-pointer"
                        onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('books.browse') }}" class="block mt-3 px-4 py-2 bg-amber-600 hover:bg-amber-500 text-black text-sm font-medium rounded-lg text-center transition-colors">
                    <i data-lucide="sliders" class="w-4 h-4 inline mr-2"></i>
                    Filter Lanjutan
                </a>
            </div>

            @if(request('category'))
                @php
                    $selectedCategory = \App\Models\Category::find(request('category'));
                @endphp
                @if($selectedCategory)
                    <div class="ui-card rounded-2xl p-4 border border-blue-500/30">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-[11px] text-blue-300 uppercase tracking-[0.2em] mb-1">Filter aktif</p>
                                <p class="text-sm text-white">
                                    Kategori: <span class="font-semibold text-amber-200">{{ $selectedCategory->name }}</span>
                                </p>
                            </div>
                            <a href="{{ route('books.index') }}" class="text-xs text-blue-200 hover:text-blue-100 flex items-center gap-1">
                                <i data-lucide="x-circle" class="w-4 h-4"></i>
                                Hapus
                            </a>
                        </div>
                    </div>
                @endif
            @endif

            <div class="ui-card rounded-2xl p-5 ">
                <h3 class="font-serif text-lg text-white mb-3">Semua Buku</h3>
                <p class="text-xs text-gray-400 mb-4">
                    Jelajahi seluruh katalog ebook dengan kurasi yang elegan.
                </p>
                <div class="space-y-3 text-xs text-gray-300">
                    <div class="flex items-center justify-between">
                        <span>Total</span>
                        <span class="font-medium text-amber-200">
                            {{ number_format($books->total() ?? $books->count()) }} judul
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Halaman ini</span>
                        <span>{{ $books->count() }} buku</span>
                    </div>
                </div>
            </div>
        </aside>
    </section>

    <!-- Grid Semua Buku -->
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-xl text-white">
                @if(request('category'))
                    Buku Kategori: {{ $selectedCategory->name ?? 'Tidak Ditemukan' }}
                @else
                    Semua Buku
                @endif
            </h2>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
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
                        <a href="{{ route('books.show', $book->id) }}"
                           class="mt-2 block w-full text-center px-3 py-2 rounded-full ui-btn-ghost text-xs">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full ui-card rounded-2xl p-10 text-center text-gray-400">
                    <p class="text-lg">Belum ada ebook tersedia.</p>
                    @if(request('category'))
                        <a href="{{ route('books.index') }}" class="text-amber-300 hover:text-amber-200 mt-4 inline-block text-sm">
                            Kembali ke semua buku
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </section>
</div>
@endsection
