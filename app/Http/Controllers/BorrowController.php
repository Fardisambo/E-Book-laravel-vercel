<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $borrows = Borrow::with('book')
            ->where('user_id', Auth::id())
            ->orderByDesc('requested_at')
            ->paginate(15);

        return view('borrows.index', compact('borrows'));
    }

    public function store(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $user = Auth::user();

        if ($book->library_available_copies <= 0) {
            return redirect()->route('books.show', $book->id)
                ->with('error', 'Maaf, buku fisik ini belum tersedia di perpustakaan saat ini.');
        }

        $request->validate([
            'duration' => 'required|integer|min:1|max:' . config('borrow.max_borrow_days', 30),
        ]);

        $existing = Borrow::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereIn('status', [Borrow::STATUS_PENDING, Borrow::STATUS_APPROVED])
            ->first();

        if ($existing) {
            return redirect()->route('books.show', $book->id)
                ->with('info', 'Anda sudah memiliki permintaan pinjam untuk buku ini. Silakan tunggu persetujuan admin.');
        }

        $borrowDays = (int) $request->input('duration');

        Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => Borrow::STATUS_PENDING,
            'requested_at' => now(),
            'borrow_days' => $borrowDays,
            'due_date' => now()->addDays($borrowDays),
        ]);

        return redirect()->route('books.show', $book->id)
            ->with('success', 'Permintaan pinjam berhasil dikirim kepada admin. Silakan tunggu persetujuan.');
    }

    public function show($id)
    {
        $borrow = Borrow::with('book')->where('user_id', Auth::id())->findOrFail($id);

        return view('borrows.show', compact('borrow'));
    }

    public function cancel($id)
    {
        $borrow = Borrow::where('user_id', Auth::id())
            ->where('status', Borrow::STATUS_PENDING)
            ->findOrFail($id);

        $borrow->update(['status' => Borrow::STATUS_CANCELLED]);

        return redirect()->route('borrows.index')
            ->with('success', 'Permintaan pinjam berhasil dibatalkan.');
    }
}
