@extends('layouts.admin')

@section('title', 'Metode Pembayaran')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-white-900">Metode Pembayaran</h1>
    <a href="{{ route('admin.payment-methods.create') }}" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
        + Tambah Metode
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
@endif

<div class="ui-card overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Akun</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biaya (%)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($paymentMethods as $method)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">{{ $method->name }}</div>
                    @if($method->description)
                        <div class="text-xs text-gray-500">{{ \Illuminate\Support\Str::limit($method->description, 40) }}</div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($method->type === 'bank')
                            bg-blue-100 text-blue-800
                        @elseif($method->type === 'e-wallet')
                            bg-purple-100 text-purple-800
                        @elseif($method->type === 'cash')
                            bg-green-100 text-green-800
                        @else
                            bg-gray-100 text-white-900
                        @endif
                    ">
                        {{ ucfirst(str_replace('-', ' ', $method->type)) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">{{ $method->account_number ?? '-' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">
                        {{ number_format($method->fee_percentage, 2) }}% 
                        @if($method->fee_fixed > 0)
                            + Rp {{ number_format($method->fee_fixed, 0, ',', '.') }}
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <form action="{{ route('admin.payment-methods.toggleActive', $method->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full cursor-pointer
                            @if($method->is_active)
                                bg-green-100 text-green-800 hover:bg-green-200
                            @else
                                bg-red-100 text-red-800 hover:bg-red-200
                            @endif
                        ">
                            {{ $method->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.payment-methods.show', $method->id) }}" class="text-[#FF2D20] hover:text-red-600 mr-4">Lihat</a>
                    <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                    <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-200">
        @if($paymentMethods instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            {{ $paymentMethods->links() }}
        @endif
    </div>
</div>
@endsection
