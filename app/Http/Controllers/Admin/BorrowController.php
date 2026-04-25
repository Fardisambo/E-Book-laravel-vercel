<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin() && !auth()->user()->isAuthor()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $borrows = Borrow::with(['user', 'book'])
            ->orderByDesc('requested_at')
            ->paginate(20);

        return view('admin.borrows.index', compact('borrows'));
    }

    public function show($id)
    {
        $borrow = Borrow::with(['user', 'book'])->findOrFail($id);

        return view('admin.borrows.show', compact('borrow'));
    }

    public function update(Request $request, $id)
    {
        $borrow = Borrow::with('book')->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', Borrow::getStatuses()),
            'admin_notes' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $newStatus = $validated['status'];
        $attributes = [
            'status' => $newStatus,
            'admin_notes' => $validated['admin_notes'] ?? null,
            'due_date' => $validated['due_date'] ?? null,
        ];

        if ($newStatus === Borrow::STATUS_APPROVED) {
            if ($borrow->book->library_available_copies <= 0) {
                return redirect()->route('admin.borrows.show', $borrow->id)
                    ->with('error', 'Tidak dapat menyetujui pinjaman: stok buku fisik tidak tersedia.');
            }

            if ($borrow->approved_at === null) {
                $attributes['approved_at'] = now();
            }

            if (empty($attributes['due_date'])) {
                $attributes['due_date'] = $borrow->borrow_days
                    ? now()->addDays($borrow->borrow_days)
                    : now()->addDays(config('borrow.default_borrow_days', 7));
            }
        }

        if ($newStatus === Borrow::STATUS_RETURNED) {
            if ($borrow->returned_at === null) {
                $attributes['returned_at'] = now();
            }

            if (! empty($borrow->due_date)) {
                $returnedAt = Carbon::parse($attributes['returned_at']);
                $dueDate = Carbon::parse($borrow->due_date);
                $lateDays = max(0, $returnedAt->diffInDays($dueDate));

                $attributes['late_days'] = $lateDays;
                $attributes['late_fee'] = $lateDays * config('borrow.daily_penalty', 5000);
            }
        }

        $borrow->update($attributes);

        return redirect()->route('admin.borrows.show', $borrow->id)
            ->with('success', 'Status pinjaman berhasil diperbarui.');
    }
}
