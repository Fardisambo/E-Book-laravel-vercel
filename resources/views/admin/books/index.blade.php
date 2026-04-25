@extends('layouts.admin')

@section('title', 'Buku')

@section('content')
<div class="flex flex-col gap-6">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-semibold text-white">Buku</h1>
            <p class="mt-2 text-sm text-gray-400">Kelola daftar buku, status publikasi, dan informasi lengkap buku.</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="ui-btn-primary">+ Tambah Buku</a>
    </div>

    <div class="ui-card rounded-[28px] border border-white/10 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-white/5 text-left text-xs uppercase tracking-[0.16em] text-gray-400">
                    <tr>
                        <th class="px-6 py-4">Cover</th>
                        <th class="px-6 py-4">Judul</th>
                        <th class="px-6 py-4">Penulis</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach($books as $book)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 align-top">
                            @if($book->cover_url)
                                @if(str_starts_with($book->cover_url, 'http'))
                                    <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-12 h-16 rounded-xl object-cover border border-white/10">
                                @else
                                    <img src="{{ asset('storage/' . $book->cover_url) }}" alt="{{ $book->title }}" class="w-12 h-16 rounded-xl object-cover border border-white/10">
                                @endif
                            @else
                                <img src="https://placehold.co/48x68?text=No+Cover" alt="{{ $book->title }}" class="w-12 h-16 rounded-xl object-cover border border-white/10">
                            @endif
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm font-semibold text-white">{{ $book->title }}</div>
                            <div class="mt-1 text-xs text-gray-500">{{ $book->categories->pluck('name')->join(', ') }}</div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm text-gray-200">{{ $book->author }}</div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            <div class="text-sm text-white">Rp{{ number_format($book->price, 0, ',', '.') }}</div>
                        </td>
                        <td class="px-6 py-4 align-top">
                            @if($book->is_published)
                                <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">Published</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-gray-300">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 align-top text-right text-sm font-medium">
                            <a href="{{ route('admin.books.edit', $book->id) }}" class="inline-flex items-center gap-2 text-amber-300 hover:text-amber-100">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-4 text-red-400 hover:text-red-200" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-white/10">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
