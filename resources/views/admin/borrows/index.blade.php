@extends('layouts.admin')

@section('title', 'Daftar Peminjaman Buku')

@section('content')
<div class="space-y-6">
    <div class="ui-card rounded-3xl border border-white/10 p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-3xl font-semibold text-white">Daftar Permintaan Peminjaman</h1>
                <p class="text-sm text-gray-400">Kelola permintaan pinjam buku fisik dari pengguna.</p>
            </div>
        </div>

        @if($borrows->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/10 text-sm text-left">
                    <thead>
                        <tr class="text-gray-300">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Pengguna</th>
                            <th class="px-4 py-3">Buku</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Diminta</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach($borrows as $borrow)
                            <tr class="border-b border-white/5">
                                <td class="px-4 py-3 text-gray-200">{{ $borrow->id }}</td>
                                <td class="px-4 py-3 text-gray-200">{{ $borrow->user->name }}</td>
                                <td class="px-4 py-3 text-gray-200">{{ $borrow->book->title }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $borrow->status === 'approved' ? 'bg-emerald-500 text-black' : ($borrow->status === 'returned' ? 'bg-sky-500 text-black' : ($borrow->status === 'rejected' ? 'bg-red-500 text-white' : ($borrow->status === 'cancelled' ? 'bg-gray-500 text-white' : 'bg-amber-500 text-black'))) }}">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-200">{{ $borrow->requested_at ? $borrow->requested_at->format('d M Y') : '-' }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.borrows.show', $borrow->id) }}" class="text-amber-300 hover:underline">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $borrows->links() }}
            </div>
        @else
            <p class="text-gray-400">Belum ada permintaan pinjam buku.</p>
        @endif
    </div>
</div>
@endsection
