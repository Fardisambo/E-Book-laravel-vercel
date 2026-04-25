<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Payment;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of purchases
     */
    public function index()
    {
        $purchases = Purchase::with(['user', 'book', 'payments'])
            ->latest()
            ->paginate(20);

        return view('admin.purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new purchase
     */
    public function create()
    {
        // Optional: untuk membuat purchase manual jika diperlukan
        return view('admin.purchases.create');
    }

    /**
     * Store a newly created purchase in storage
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified purchase
     */
    public function show($id)
    {
        $purchase = Purchase::with(['user', 'book', 'payments.paymentMethod'])
            ->findOrFail($id);

        return view('admin.purchases.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified purchase
     */
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('admin.purchases.edit', compact('purchase'));
    }

    /**
     * Update the specified purchase in storage
     */
    public function update(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $purchase->update($validated);

        return redirect()
            ->route('admin.purchases.show', $purchase->id)
            ->with('success', 'Pesanan berhasil diperbarui');
    }

    /**
     * Remove the specified purchase from storage
     */
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        
        // Cegah penghapusan purchase yang sudah memiliki payment
        if ($purchase->payments()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Tidak dapat menghapus pesanan yang sudah memiliki pembayaran');
        }

        $purchase->delete();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }

    /**
     * Update payment status
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);
        $payment = $purchase->payments()->findOrFail($request->payment_id);

        $validated = $request->validate([
            'status' => 'required|in:pending,completed,failed,cancelled',
        ]);

        $payment->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Status pembayaran berhasil diperbarui');
    }

    /**
     * Create payment for purchase
     */
    public function createPayment(Request $request, $id)
    {
        $purchase = Purchase::findOrFail($id);

        $validated = $request->validate([
            'method' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $payment = Payment::create([
            'user_id' => $purchase->user_id,
            'paymentable_type' => Purchase::class,
            'paymentable_id' => $purchase->id,
            'method' => $validated['method'],
            'amount' => $validated['amount'],
            'status' => 'pending',
        ]);

        return redirect()
            ->route('admin.purchases.show', $purchase->id)
            ->with('success', 'Pembayaran berhasil dibuat');
    }
}
