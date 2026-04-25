@extends('layouts.admin')

@section('title', 'Detail Peminjaman Buku')

@section('content')
<div class="space-y-6">
    <div class="ui-card rounded-3xl border border-white/10 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-semibold text-white">Detail Permintaan Peminjaman</h1>
                <p class="text-sm text-gray-400">Ubah status permintaan dan catatan admin.</p>
            </div>
            <a href="{{ route('admin.borrows.index') }}" class="text-amber-300 hover:underline">Kembali ke daftar</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 mb-6">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-400">Pengguna</p>
                    <p class="text-white">{{ $borrow->user->name }} ({{ $borrow->user->email }})</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Buku</p>
                    <p class="text-white">{{ $borrow->book->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Diminta pada</p>
                    <p class="text-white">{{ $borrow->requested_at ? $borrow->requested_at->format('d M Y H:i') : '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Status saat ini</p>
                    <p class="text-white">{{ ucfirst($borrow->status) }}</p>
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
                        <p class="text-sm text-gray-400">Tanggal kembali</p>
                        <p class="text-white">{{ $borrow->due_date->format('d M Y') }}</p>
                    </div>
                @endif
                @if($borrow->late_fee > 0)
                    <div>
                        <p class="text-sm text-gray-400">Denda Keterlambatan</p>
                        <p class="text-white">Rp {{ number_format($borrow->late_fee, 0, ',', '.') }} ({{ $borrow->late_days }} hari terlambat)</p>
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
            </div>
            <div class="bg-slate-900/70 rounded-3xl p-6 space-y-4">
                <div>
                    <p class="text-sm text-gray-400">Stok perpustakaan</p>
                    <p class="text-white">{{ $borrow->book->library_total_copies }} buku</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Jumlah dipinjam saat ini</p>
                    <p class="text-white">{{ $borrow->book->library_borrowed_copies }} buku</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400">Sisa tersedia</p>
                    <p class="text-white">{{ $borrow->book->library_available_copies }} buku</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.borrows.update', $borrow->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Status</label>
                    <select name="status" class="w-full rounded-3xl bg-slate-900/80 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                        @foreach(\App\Models\Borrow::getStatuses() as $status)
                            <option class="bg-slate-900/90 text-white" value="{{ $status }}" {{ $borrow->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Tanggal Kembali (Opsional)</label>
                    <input type="date" name="due_date" value="{{ old('due_date', $borrow->due_date?->format('Y-m-d')) }}" class="w-full rounded-3xl bg-slate-900/80 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Catatan Admin</label>
                <textarea name="admin_notes" rows="4" class="w-full rounded-3xl bg-slate-900/80 border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-amber-400">{{ old('admin_notes', $borrow->admin_notes) }}</textarea>
            </div>

            <div class="flex flex-wrap gap-4">
                <button type="submit" class="inline-flex items-center justify-center rounded-full bg-amber-400 px-6 py-3 text-sm font-semibold text-black hover:bg-amber-300 transition">Perbarui Status</button>
                <a href="{{ route('admin.borrows.index') }}" class="inline-flex items-center justify-center rounded-full border border-white/10 px-6 py-3 text-sm text-gray-300 hover:bg-white/5 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
