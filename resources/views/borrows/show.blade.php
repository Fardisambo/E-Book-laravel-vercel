@extends('layouts.app')

@section('title', 'Detail Reservasi Pinjaman')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="ui-card rounded-3xl  p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-semibold text-white">Detail Permintaan Pinjam</h1>
            <p class="text-sm text-gray-400">Status pinjaman buku fisik Anda.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-400">Judul Buku</p>
                    <h2 class="text-xl font-semibold text-white">{{ $borrow->book->title }}</h2>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Status</p>
                    <p class="text-lg font-semibold text-white">{{ ucfirst($borrow->status) }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Diajukan pada</p>
                    <p class="text-white">{{ $borrow->requested_at->format('d M Y H:i') }}</p>
                </div>
                @if($borrow->approved_at)
                <div>
                    <p class="text-sm text-gray-400">Disetujui pada</p>
                    <p class="text-white">{{ $borrow->approved_at->format('d M Y H:i') }}</p>
                </div>
                @endif
                @if($borrow->borrow_days)
                <div>
                    <p class="text-sm text-gray-400">Durasi Pinjam</p>
                    <p class="text-white">{{ $borrow->borrow_days }} hari</p>
                </div>
                @endif
                @if($borrow->due_date)
                <div>
                    <p class="text-sm text-gray-400">Tanggal Kembali</p>
                    <p class="text-white">{{ $borrow->due_date->format('d M Y') }}</p>
                </div>
                @endif
                @if($borrow->late_fee > 0)
                <div>
                    <p class="text-sm text-gray-400">Denda Keterlambatan</p>
                    <p class="text-white">Rp {{ number_format($borrow->late_fee, 0, ',', '.') }} @if($borrow->late_days)({{ $borrow->late_days }} hari terlambat)@endif</p>
                </div>
                @elseif($borrow->is_overdue)
                <div>
                    <p class="text-sm text-gray-400">Denda Saat Ini</p>
                    <p class="text-white">Rp {{ number_format($borrow->late_fee, 0, ',', '.') }} (Belum dikembalikan)</p>
                </div>
                @endif
                @if($borrow->returned_at)
                <div>
                    <p class="text-sm text-gray-400">Dikembalikan pada</p>
                    <p class="text-white">{{ $borrow->returned_at->format('d M Y H:i') }}</p>
                </div>
                @endif
                @if($borrow->notes)
                <div>
                    <p class="text-sm text-gray-400">Catatan Anda</p>
                    <p class="text-white">{{ $borrow->notes }}</p>
                </div>
                @endif
                @if($borrow->admin_notes)
                <div>
                    <p class="text-sm text-gray-400">Catatan Admin</p>
                    <p class="text-white">{{ $borrow->admin_notes }}</p>
                </div>
                @endif
            </div>

            <div class="bg-slate-900/70 rounded-3xl p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-400">Penulis</p>
                    <p class="text-white">{{ $borrow->book->author }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Stok Perpustakaan</p>
                    <p class="text-white">{{ $borrow->book->library_total_copies }} buku</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Sisa Tersedia</p>
                    <p class="text-white">{{ $borrow->book->library_available_copies }} buku</p>
                </div>
                <div class="rounded-3xl border border-amber-500/30 bg-amber-500/10 p-4 text-sm text-amber-100">
                    <p class="font-semibold">Tunjukkan halaman ini kepada petugas perpustakaan saat mengambil buku.</p>
                    <p class="mt-2 text-gray-300">Status reservasi: {{ ucfirst($borrow->status) }}.</p>
                </div>
                <div>
                    <a href="{{ route('borrows.index') }}" class="inline-flex items-center justify-center rounded-full bg-amber-400 px-5 py-3 text-sm font-semibold text-black hover:bg-amber-300 transition">Kembali ke Reservasi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
