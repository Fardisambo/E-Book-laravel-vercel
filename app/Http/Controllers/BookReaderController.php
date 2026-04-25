<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class BookReaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Read book
     */
    public function read($id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        // Check if user has purchased the book
        $hasPurchased = $user->hasPurchasedBook($book->id);
        
        // Check if user has active subscription
        $hasSubscription = $user->hasActiveSubscription();

        // Buku gratis atau sudah beli/langganan = akses penuh
        $canReadFull = $hasPurchased || $hasSubscription || $book->isFree();

        return view('books.read', compact('book', 'canReadFull', 'hasPurchased', 'hasSubscription'));
    }

    /**
     * Download book.
     * Download dilindungi dengan watermark dan copyright protection.
     * Buku gratis hanya dapat diakses untuk membaca, bukan diunduh.
     * Buku berbayar: download hanya diizinkan untuk pengguna yang telah membeli.
     */
    public function download($id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        // Hanya buku yang dibeli yang dapat diunduh
        $canDownload = $user->hasPurchasedBook($book->id) && !$book->isFree();
        
        if (!$canDownload) {
            return redirect()->route('books.show', $book->id)
                ->with('error', 'Pengunduhan tidak diizinkan. Hanya buku yang telah dibeli dapat diunduh, dan download dilindungi untuk melindungi hak cipta penulis. Silakan baca buku di halaman pembacaan kami.');
        }

        if (!$book->file_path || !Storage::disk('public')->exists($book->file_path)) {
            return redirect()->back()->with('error', 'File buku tidak tersedia.');
        }

        $book->increment('downloads');
        
        // Log download attempt untuk keamanan
        \Log::info('Book Download', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'book_title' => $book->title,
            'timestamp' => now(),
            'ip_address' => request()->ip(),
        ]);

        // Add copyright header ke downloaded file
        return Storage::disk('public')->download(
            $book->file_path,
            $book->slug . '.' . $book->file_type,
            ['Content-Disposition' => 'attachment; filename="' . $book->slug . '.' . $book->file_type . '"; filename*=UTF-8\'\'' . $book->slug . '.' . $book->file_type]
        );
    }

    /**
     * Purchase book.
     * Buku gratis: langsung status completed, tidak melalui pembayaran.
     */
    public function purchase($id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        // Check if user already has a pending or completed purchase
        $existingPurchase = Purchase::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if ($existingPurchase) {
            if ($existingPurchase->status === 'pending') {
                return redirect()->route('payments.create-purchase', $existingPurchase->id)
                    ->with('info', 'Anda sudah memiliki pembayaran pending untuk buku ini. Silakan selesaikan pembayaran.');
            }
            return redirect()->route('books.show', $book->id)
                ->with('info', 'Anda sudah membeli buku ini.');
        }

        // Buku gratis: tidak perlu pembayaran, langsung selesaikan
        if ($book->isFree()) {
            try {
                Purchase::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'price' => 0,
                    'status' => 'completed',
                    'purchased_at' => now(),
                ]);
            } catch (QueryException $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    return redirect()->route('books.show', $book->id)
                        ->with('info', 'Anda sudah membeli buku ini.');
                }
                throw $e;
            }
            return redirect()->route('books.read', $book->id)
                ->with('success', 'Buku gratis berhasil ditambahkan. Silakan baca atau unduh.');
        }

        // Buku berbayar: buat pesanan dan arahkan ke pembayaran
        try {
            $purchase = Purchase::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'price' => $book->price,
                'status' => 'pending',
            ]);
        } catch (QueryException $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                // Coba ambil purchase yang ada
                $existingPurchase = Purchase::where('user_id', $user->id)
                    ->where('book_id', $book->id)
                    ->first();
                
                if ($existingPurchase && $existingPurchase->status === 'pending') {
                    return redirect()->route('payments.create-purchase', $existingPurchase->id)
                        ->with('info', 'Anda sudah memiliki pembayaran pending untuk buku ini. Silakan selesaikan pembayaran.');
                }
                return redirect()->route('books.show', $book->id)
                    ->with('info', 'Anda sudah membeli buku ini.');
            }
            throw $e;
        }

        return redirect()->route('payments.create-purchase', $purchase->id)
            ->with('success', 'Silakan lakukan pembayaran untuk menyelesaikan pembelian.');
    }
}
