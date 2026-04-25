@extends('layouts.app')

@section('title', 'Reservasi Pinjam Buku')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-semibold text-white">Reservasi Pinjam Buku</h1>
            <p class="text-sm text-gray-400">Tunjukkan halaman ini kepada petugas perpustakaan untuk memperlihatkan reservasi yang sudah Anda buat.</p>
        </div>
    </div>

    <div class="ui-card rounded-3xl  p-6">
        @if($borrows->count())
            <div class="space-y-4">
                @foreach($borrows as $borrow)
                    <div class="border-b border-white/10 pb-4 last:border-b-0">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold text-white">{{ $borrow->book->title }}</h2>
                                <p class="text-sm text-gray-400">{{ $borrow->book->author }}</p>
                                <p class="text-sm text-gray-300 mt-1">Diminta: {{ $borrow->requested_at->format('d M Y H:i') }}</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-2 text-sm">
                                <span class="px-3 py-1 rounded-full {{ $borrow->status === 'approved' ? 'bg-emerald-500 text-black' : ($borrow->status === 'returned' ? 'bg-sky-500 text-black' : ($borrow->status === 'rejected' ? 'bg-red-500 text-white' : ($borrow->status === 'cancelled' ? 'bg-gray-500 text-white' : 'bg-amber-500 text-black'))) }}">
                                    {{ ucfirst($borrow->status) }}
                                </span>
                                <a href="{{ route('borrows.show', $borrow->id) }}" class="text-amber-300 hover:underline">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $borrows->links() }}
            </div>
        @else
            <p class="text-gray-300">Belum ada permintaan pinjam buku. Kunjungi halaman buku dan ajukan pinjaman.</p>
        @endif
    </div>
</div>
@endsection
