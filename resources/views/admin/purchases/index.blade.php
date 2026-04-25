@extends('layouts.admin')

@section('title', 'Pesanan Buku')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-white-900">Pesanan Buku</h1>
    <div class="flex gap-3">
        <a href="{{ route('admin.purchases.create') }}" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
            + Pesanan Baru
        </a>
    </div>
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
    <table class="min-w-full divide-y divide-white-200">
        <thead class="bg-white-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Pembeli</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Buku</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Harga</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Pembayaran</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-white-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-white-200">
            @foreach($purchases as $purchase)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">#{{ $purchase->id }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">{{ $purchase->user->name }}</div>
                    <div class="text-xs text-white-500">{{ $purchase->user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">{{ $purchase->book->title }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">Rp {{ number_format($purchase->price, 0, ',', '.') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($purchase->status === 'completed')
                            bg-green-100 text-green-800
                        @elseif($purchase->status === 'pending')
                            bg-yellow-100 text-yellow-800
                        @elseif($purchase->status === 'failed')
                            bg-red-100 text-red-800
                        @elseif($purchase->status === 'cancelled')
                            bg-white-100 text-white-800
                        @endif
                    ">
                        {{ ucfirst($purchase->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($purchase->payments()->count() > 0)
                        <div class="text-xs">
                            @foreach($purchase->payments as $payment)
                                <span class="inline-block px-2 py-1 rounded
                                    @if($payment->status === 'completed')
                                        bg-green-100 text-green-800
                                    @elseif($payment->status === 'pending')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ $payment->method }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-xs text-white-500">Belum ada</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-500">{{ $purchase->created_at->format('d M Y') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.purchases.show', $purchase->id) }}" class="text-[#FF2D20] hover:text-red-600 mr-4">Lihat</a>
                    <a href="{{ route('admin.purchases.edit', $purchase->id) }}" class="text-blue-600 hover:text-blue-800 mr-4">Edit</a>
                    <form action="{{ route('admin.purchases.destroy', $purchase->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-white-200">
        @if($purchases instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            {{ $purchases->links() }}
        @endif
    </div>
</div>
@endsection
