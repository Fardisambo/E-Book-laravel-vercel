@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-white-900">Kategori</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-[#FF2D20] text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
        + Tambah Kategori
    </a>
</div>

<div class="ui-card overflow-hidden">
    <table class="min-w-full divide-y divide-white-200">
        <thead class="bg-white-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Deskripsi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Jumlah Buku</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-white-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-white-200">
            @foreach($categories as $category)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">{{ $category->name }}</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-white-500">{{ \Illuminate\Support\Str::limit($category->description ?? '-', 50) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">{{ $category->books_count ?? $category->books()->count() ?? 0 }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-[#FF2D20] hover:text-red-600 mr-4">Edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
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
        @if($categories instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            {{ $categories->links() }}
        @endif
    </div>
</div>
@endsection
