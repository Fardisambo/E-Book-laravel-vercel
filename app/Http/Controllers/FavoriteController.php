<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display the user's favorite books.
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites()
            ->with('categories', 'authorUser', 'reviews')
            ->paginate(12);

        return view('favorites.index', compact('favorites', 'user'));
    }

    /**
     * Add or remove a book from favorites.
     */
    public function toggle(Request $request, Book $book)
    {
        $user = Auth::user();

        if ($user->hasFavorited($book->id)) {
            // Remove from favorites
            $user->favorites()->detach($book->id);
            $message = 'Buku dihapus dari favorit';
        } else {
            // Add to favorites
            $user->favorites()->attach($book->id);
            $message = 'Buku ditambahkan ke favorit';
        }

        // Check if it's an AJAX request
        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => $message,
                'is_favorited' => $user->fresh()->hasFavorited($book->id),
            ], 200)
            ->header('Content-Type', 'application/json');
        }

        return back()->with('success', $message);
    }

    /**
     * Add a book to favorites.
     */
    public function store(Request $request, Book $book)
    {
        $user = Auth::user();

        if (!$user->hasFavorited($book->id)) {
            $user->favorites()->attach($book->id);
        }

        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Buku ditambahkan ke favorit',
                'is_favorited' => true,
            ], 200)
            ->header('Content-Type', 'application/json');
        }

        return back()->with('success', 'Buku ditambahkan ke favorit');
    }

    /**
     * Remove a book from favorites.
     */
    public function destroy(Request $request, Book $book)
    {
        $user = Auth::user();

        if ($user->hasFavorited($book->id)) {
            $user->favorites()->detach($book->id);
        }

        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Buku dihapus dari favorit',
                'is_favorited' => false,
            ], 200)
            ->header('Content-Type', 'application/json');
        }

        return back()->with('success', 'Buku dihapus dari favorit');
    }
}
