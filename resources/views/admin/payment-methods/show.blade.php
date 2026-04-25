@extends('layouts.admin')

@section('title', 'Detail Metode Pembayaran')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.payment-methods.index') }}" class="text-[#FF2D20] hover:text-red-600">← Kembali</a>
    <h1 class="text-3xl font-bold text-white-900 mt-2">{{ $paymentMethod->name }}</h1>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <div class="ui-card p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">Nama Metode</label>
                    <p class="text-lg font-semibold text-white-900">{{ $paymentMethod->name }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">Tipe</label>
                    <p class="text-lg">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($paymentMethod->type === 'bank')
                                bg-blue-100 text-blue-800
                            @elseif($paymentMethod->type === 'e-wallet')
                                bg-purple-100 text-purple-800
                            @elseif($paymentMethod->type === 'cash')
                                bg-green-100 text-green-800
                            @else
                                bg-gray-100 text-white-900
                            @endif
                        ">
                            {{ ucfirst(str_replace('-', ' ', $paymentMethod->type)) }}
                        </span>
                    </p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">Status</label>
                    <p class="text-lg">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            @if($paymentMethod->is_active)
                                bg-green-100 text-green-800
                            @else
                                bg-red-100 text-red-800
                            @endif
                        ">
                            {{ $paymentMethod->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">Urutan Tampil</label>
                    <p class="text-lg font-semibold text-white-900">{{ $paymentMethod->display_order }}</p>
                </div>

                @if($paymentMethod->description)
                <div class="col-span-2">
                    <label class="text-sm font-medium text-gray-500 block mb-1">Deskripsi</label>
                    <p class="text-white-900">{{ $paymentMethod->description }}</p>
                </div>
                @endif

                <!-- @if($paymentMethod->account_number)
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">No. Rekening / Akun</label>
                    <p class="font-mono text-white-900 font-semibold">{{ $paymentMethod->account_number }}</p>
                </div>
                @endif

                @if($paymentMethod->account_holder)
                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">Nama Pemilik Akun</label>
                    <p class="text-white-900">{{ $paymentMethod->account_holder }}</p>
                </div>
                @endif -->

                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">Biaya Persentase</label>
                    <p class="text-white-900 font-semibold">{{ number_format($paymentMethod->fee_percentage, 2) }}%</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-500 block mb-1">Biaya Tetap</label>
                    <p class="text-white-900 font-semibold">Rp {{ number_format($paymentMethod->fee_fixed, 0, ',', '.') }}</p>
                </div>

                @if($paymentMethod->icon_url)
                <div class="col-span-2">
                    <label class="text-sm font-medium text-gray-500 block mb-1">Icon/Logo</label>
                    <img src="{{ $paymentMethod->icon_url }}" alt="{{ $paymentMethod->name }}" class="h-16 w-auto">
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <div class="ui-card p-6">
            <h2 class="text-xl font-bold text-white-900 mb-4">Aksi</h2>
            
            <div class="space-y-2">
                <a href="{{ route('admin.payment-methods.edit', $paymentMethod->id) }}" 
                    class="block w-full text-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                    Edit
                </a>
                <form action="{{ route('admin.payment-methods.toggleActive', $paymentMethod->id) }}" method="POST" class="block">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full px-4 py-2 rounded transition-colors
                        @if($paymentMethod->is_active)
                            bg-orange-500 text-white hover:bg-orange-600
                        @else
                            bg-green-600 text-white hover:bg-green-700
                        @endif
                    ">
                        {{ $paymentMethod->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>
                <button onclick="if(confirm('Yakin ingin menghapus metode pembayaran ini?')) document.getElementById('deleteForm').submit()" 
                    class="block w-full text-center bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                    Hapus
                </button>
            </div>

            <form id="deleteForm" action="{{ route('admin.payment-methods.destroy', $paymentMethod->id) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection
