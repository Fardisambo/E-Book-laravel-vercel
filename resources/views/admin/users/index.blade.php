@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex flex-col gap-3 sm:flex-row sm:justify-between sm:items-center mb-6">
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-white-900">Users</h1>
        <p class="text-sm text-gray-400 mt-1">Kelola akun pengguna, role, dan aktivitas pembelian/langganan.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="ui-btn-primary">
        + Tambah User
    </a>
</div>

<div class="ui-card overflow-hidden">
    <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-white-200">
        <thead class="bg-white-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Pembelian</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white-500 uppercase tracking-wider">Langganan</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-white-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-white-200">
            @foreach($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-white-900">{{ $user->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">{{ $user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                        {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-white-100 text-white-800' }}">
                        {{ $user->role === 'author' ? 'Petugas' : ucfirst($user->role) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">{{ $user->purchases_count }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-white-900">{{ $user->subscriptions_count }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-amber-400 hover:text-amber-300 mr-4">Edit</a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="px-6 py-4 border-t border-white-200">
        {{ $users->links() }}
    </div>
</div>
@endsection
