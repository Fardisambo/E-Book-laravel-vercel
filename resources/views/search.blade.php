@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-serif text-2xl text-white">Hasil Pencarian</h2>
            <p class="text-sm text-gray-400">Menampilkan hasil untuk: <span class="text-amber-200 font-medium">{{ $q ?? '-' }}</span></p>
        </div>

        <section class="grid gap-5 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
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
                    <p class="text-lg">Tidak ditemukan hasil untuk kata kunci Anda.</p>
                    <a href="{{ route('books.index') }}" class="text-amber-300 hover:text-amber-200 mt-4 inline-block text-sm">Kembali ke semua buku</a>
                </div>
            @endforelse
        </section>

        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
@endsection
