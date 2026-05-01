<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ReadingProgress;
use App\Models\Purchase;
use App\Models\Borrow;
use App\Models\Bookmark;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        // Get reading statistics
        $readingStats = [
            'totalBooksRead' => ReadingProgress::where('user_id', $user->id)
                ->where('progress_percentage', 100)
                ->count(),
            'currentlyReading' => ReadingProgress::where('user_id', $user->id)
                ->where('progress_percentage', '>', 0)
                ->where('progress_percentage', '<', 100)
                ->count(),
            'totalPagesRead' => ReadingProgress::where('user_id', $user->id)
                ->sum('current_page'),
            'purchasedBooks' => Purchase::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
            'activeBorrows' => Borrow::where('user_id', $user->id)
                ->where('status', 'active')
                ->count(),
            'favoriteBooks' => Bookmark::where('user_id', $user->id)->count(),
        ];

        // Get recent reading progress
        $recentReading = ReadingProgress::where('user_id', $user->id)
            ->with('book')
            ->orderBy('last_read_at', 'desc')
            ->take(5)
            ->get();

        return view('profile.show', compact('user', 'readingStats', 'recentReading'));
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}

