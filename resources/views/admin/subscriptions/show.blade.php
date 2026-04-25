@extends('layouts.admin')

@section('title', 'Detail Langganan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.subscriptions.index') }}" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">Detail Langganan #{{ $subscription->id }}</h1>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Informasi Langganan -->
        <div class="ui-card p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Informasi Langganan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-white-500">ID</label>
                    <p class="text-lg text-white-900">{{ $subscription->id }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Status</label>
                    <p class="text-lg">
                        <span class="px-3 py-1 rounded-full font-semibold
                            @if($subscription->status === 'active')
                                bg-green-100 text-green-800
                            @elseif($subscription->status === 'pending')
                                bg-yellow-100 text-yellow-800
                            @elseif($subscription->status === 'expired')
                                bg-white-100 text-white-800
                            @elseif($subscription->status === 'cancelled')
                                bg-red-100 text-red-800
                            @endif
                        ">
                            @if($subscription->status === 'active')
                                Aktif
                            @elseif($subscription->status === 'pending')
                                Tertunda
                            @elseif($subscription->status === 'expired')
                                Berakhir
                            @elseif($subscription->status === 'cancelled')
                                Dibatalkan
                            @endif
                        </span>
                    </p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Paket</label>
                    <p class="text-lg text-white-900">{{ $subscription->plan === 'monthly' ? 'Bulanan' : 'Tahunan' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Harga</label>
                    <p class="text-lg font-bold text-white-900">Rp {{ number_format($subscription->amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Mulai</label>
                    <p class="text-lg text-white-900">{{ $subscription->started_at?->format('d M Y') ?? '-' }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Berakhir</label>
                    <p class="text-lg text-white-900">{{ $subscription->expires_at?->format('d M Y') ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Data Pengguna -->
        <div class="ui-card p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Data Pengguna</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-white-500">Nama</label>
                    <p class="text-lg text-white-900">{{ $subscription->user->name }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Email</label>
                    <p class="text-lg text-white-900">{{ $subscription->user->email }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Role</label>
                    <p class="text-lg text-white-900">{{ $subscription->user->role }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-white-500">Bergabung Sejak</label>
                    <p class="text-lg text-white-900">{{ $subscription->user->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="ui-card p-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Pembayaran</h2>

            @if($subscription->payments->count() > 0)
                <div class="space-y-3">
                    @foreach($subscription->payments as $payment)
                    <div class="border border-white-200 rounded-lg p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-white-900">{{ $payment->method }}</p>
                                <p class="text-sm text-white-500">
                                    ID Transaksi: {{ $payment->transaction_id ?? '-' }}
                                </p>
                                <p class="text-sm text-white-500">
                                    {{ $payment->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-lg text-white-900">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </p>
                                <span class="text-xs px-2 py-1 rounded
                                    @if($payment->status === 'completed')
                                        bg-green-100 text-green-800
                                    @elseif($payment->status === 'pending')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-red-100 text-red-800
                                    @endif
                                ">
                                    @if($payment->status === 'completed')
                                        Selesai
                                    @elseif($payment->status === 'pending')
                                        Tertunda
                                    @else
                                        Gagal
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-white-500">Belum ada pembayaran</p>
            @endif
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Aksi -->
        <div class="ui-card p-6 mb-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Aksi</h2>
            
            <div class="flex flex-col gap-3">
                <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-center">
                    Edit
                </a>
                
                <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Ubah Status -->
        <div class="ui-card p-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Ubah Status</h2>
            
            <form action="{{ route('admin.subscriptions.updateStatus', $subscription->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <select name="status" class="w-full border border-white-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FF2D20]" required>
                        <option value="pending" {{ $subscription->status === 'pending' ? 'selected' : '' }}>Tertunda</option>
                        <option value="active" {{ $subscription->status === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="expired" {{ $subscription->status === 'expired' ? 'selected' : '' }}>Berakhir</option>
                        <option value="cancelled" {{ $subscription->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Perbarui Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
