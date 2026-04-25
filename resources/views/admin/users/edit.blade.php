@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-white-900 mb-6">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="ui-card p-6">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-white-700 mb-2">Nama *</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent"
                    value="{{ old('name', $user->name) }}">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white-700 mb-2">Email *</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent"
                    value="{{ old('email', $user->email) }}">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white-700 mb-2">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white-700 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-white-700 mb-2">Role *</label>
                <select name="role" id="role" required
                    class="w-full px-4 py-2 border border-white-300 rounded-lg focus:ring-2 focus:ring-[#FF2D20] focus:border-transparent">
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
            </div>
        </div>

        <div class="mt-6 flex space-x-4">
            <button type="submit" class="bg-[#FF2D20] text-white px-6 py-2 rounded-lg hover:bg-red-600 transition-colors">
                Update
            </button>
            <a href="{{ route('admin.users.index') }}" class="bg-white-200 text-white-700 px-6 py-2 rounded-lg hover:bg-white-300 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
