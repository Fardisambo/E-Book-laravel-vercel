@extends('layouts.app')

@section('title', 'Daftar Buku Saya')

@section('content')
<div class="min-h-screen bg-[#0f0f0f] py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-semibold text-white">Daftar Buku Saya</h1>
                <p class="mt-2 text-sm text-gray-400">Kelola semua buku Anda di satu tempat. Hanya buku yang Anda buat dapat diedit.</p>
            </div>
            <a href="{{ route('author.books.create') }}" class="inline-flex items-center justify-center rounded-full bg-amber-300 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-amber-200 transition">Upload Buku Baru</a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-3xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if($books->count())
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach($books as $book)
                    <div class="ui-card rounded-[28px]  p-6 shadow-2xl flex flex-col h-full">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-20 rounded-3xl bg-white/5 overflow-hidden ">
                                @if($book->cover_url)
                                    @if(str_starts_with($book->cover_url, 'http'))
                                        <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $book->cover_url) }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                    @endif
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-2xl text-gray-400">
                                        <i data-lucide="book-open"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h2 class="text-lg font-semibold text-white">{{ $book->title }}</h2>
                                <p class="mt-2 text-sm text-gray-400">{{ \Illuminate\Support\Str::limit($book->description, 90) }}</p>
                            </div>
                        </div>

                        <div class="mt-5 flex-1 flex flex-col justify-between">
                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="rounded-2xl bg-white/5 px-4 py-3 text-sm text-gray-300">
                                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Harga</p>
                                    <p class="mt-2 font-semibold text-white">Rp{{ number_format($book->price ?? 0, 0, ',', '.') }}</p>
                                </div>
                                <div class="rounded-2xl bg-white/5 px-4 py-3 text-sm text-gray-300">
                                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Halaman</p>
                                    <p class="mt-2 font-semibold text-white">{{ $book->total_pages ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mt-4 min-h-[3.5rem] flex flex-wrap items-center gap-2">
                                @foreach($book->categories as $category)
                                    <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-gray-300">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a href="{{ route('author.books.edit', $book->id) }}" class="rounded-full bg-amber-300 px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-amber-200 transition min-w-[100px] text-center">Edit</a>
                            <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="rounded-full  px-4 py-2 text-sm text-gray-300 hover:bg-white/5 transition min-w-[100px] text-center">File</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $books->links() }}
            </div>
        @else
            <div class="rounded-3xl  bg-white/5 p-10 text-center text-gray-300">
                <p class="mb-4 text-lg font-medium text-white">Belum ada buku.</p>
                <a href="{{ route('author.books.create') }}" class="inline-flex items-center justify-center rounded-full bg-amber-300 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-amber-200 transition">Upload Buku Pertama</a>
            </div>
        @endif
    </div>
</div>
@endsection
