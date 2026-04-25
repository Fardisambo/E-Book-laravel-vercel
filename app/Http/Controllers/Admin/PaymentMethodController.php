<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
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
     * Display a listing of payment methods
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::orderBy('display_order')
            ->paginate(20);

        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new payment method
     */
    public function create()
    {
        $types = ['bank', 'e-wallet', 'qris', 'other'];
        return view('admin.payment-methods.create', compact('types'));
    }

    /**
     * Store a newly created payment method in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payment_methods',
            'type' => 'required|in:bank,e-wallet,qris,other',
            'description' => 'nullable|string',
            'account_number' => 'nullable|string|max:255',
            'account_holder' => 'nullable|string|max:255',
            'icon_url' => 'nullable|url',
            'fee_percentage' => 'nullable|numeric|min:0|max:100',
            'fee_fixed' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Set default values if not provided
        $validated['is_active'] = $request->has('is_active');
        $validated['fee_percentage'] = $validated['fee_percentage'] ?? 0;
        $validated['fee_fixed'] = $validated['fee_fixed'] ?? 0;
        $validated['display_order'] = $validated['display_order'] ?? 0;

        PaymentMethod::create($validated);

        return redirect()
            ->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified payment method
     */
    public function show($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('admin.payment-methods.show', compact('paymentMethod'));
    }

    /**
     * Show the form for editing the specified payment method
     */
    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $types = ['bank', 'e-wallet', 'qris', 'other'];
        return view('admin.payment-methods.edit', compact('paymentMethod', 'types'));
    }

    /**
     * Update the specified payment method in storage
     */
    public function update(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:payment_methods,name,' . $id,
            'type' => 'required|in:bank,e-wallet,qris,other',
            'description' => 'nullable|string',
            'account_number' => 'nullable|string|max:255',
            'account_holder' => 'nullable|string|max:255',
            'icon_url' => 'nullable|url',
            'fee_percentage' => 'nullable|numeric|min:0|max:100',
            'fee_fixed' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['fee_percentage'] = $validated['fee_percentage'] ?? 0;
        $validated['fee_fixed'] = $validated['fee_fixed'] ?? 0;

        $paymentMethod->update($validated);

        return redirect()
            ->route('admin.payment-methods.show', $paymentMethod->id)
            ->with('success', 'Metode pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified payment method from storage
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);

        // Cegah penghapusan jika sudah digunakan
        if ($paymentMethod->payments()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Tidak dapat menghapus metode pembayaran yang sudah digunakan');
        }

        $paymentMethod->delete();

        return redirect()
            ->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil dihapus');
    }

    /**
     * Toggle active status
     */
    public function toggleActive($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->update(['is_active' => !$paymentMethod->is_active]);

        return redirect()
            ->back()
            ->with('success', 'Status metode pembayaran berhasil diubah');
    }
}
