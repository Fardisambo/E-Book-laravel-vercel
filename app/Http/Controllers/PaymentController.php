<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Subscription;
use App\Models\PaymentMethod;
use App\Models\AuthorPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show form to select payment method for purchase
     */
    public function createPurchasePayment(Request $request, $purchaseId)
    {
        $purchase = Purchase::where('user_id', Auth::id())
            ->with('book.authorUser')
            ->findOrFail($purchaseId);

        if ($purchase->status === 'completed') {
            return redirect()->back()->with('error', 'Pembelian sudah dibayar.');
        }

        $paymentMethods = $purchase->book->authorUser && $purchase->book->authorUser->isAuthor()
            ? AuthorPaymentMethod::where('user_id', $purchase->book->authorUser->id)
                ->where('is_active', true)
                ->get()
            : PaymentMethod::where('is_active', true)
                ->orderBy('display_order')
                ->get();

        return view('payments.create-purchase', compact('purchase', 'paymentMethods'));
    }

    /**
     * Show form to select payment method for subscription.
     * Jika langganan sudah aktif atau sudah ada payment pending, redirect ke halaman yang sesuai.
     */
    public function createSubscriptionPayment(Request $request, $subscriptionId)
    {
        $subscription = Subscription::where('user_id', Auth::id())
            ->findOrFail($subscriptionId);

        if ($subscription->status !== 'pending') {
            return redirect()->route('subscriptions.index')
                ->with('error', 'Langganan ini sudah diproses. Silakan cek halaman Langganan.');
        }

        $pendingPayment = $subscription->payments()->where('status', 'pending')->first();
        if ($pendingPayment) {
            return redirect()->route('payments.show', $pendingPayment->id)
                ->with('info', 'Anda sudah memiliki pembayaran untuk langganan ini. Silakan selesaikan pembayaran.');
        }

        $paymentMethods = PaymentMethod::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('payments.create-subscription', compact('subscription', 'paymentMethods'));
    }

    /**
     * Store payment for purchase
     */
    public function storePurchasePayment(Request $request, $purchaseId)
    {
        $purchase = Purchase::where('user_id', Auth::id())
            ->with('book.authorUser')
            ->findOrFail($purchaseId);

        $isAuthorSale = $purchase->book->authorUser && $purchase->book->authorUser->isAuthor();

        if ($isAuthorSale) {
            $validated = $request->validate([
                'payment_method_id' => 'required|exists:author_payment_methods,id',
                'transfer_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            $paymentMethod = AuthorPaymentMethod::where('user_id', $purchase->book->authorUser->id)
                ->where('is_active', true)
                ->findOrFail($validated['payment_method_id']);

            $paymentData = [
                'user_id' => Auth::id(),
                'paymentable_type' => Purchase::class,
                'paymentable_id' => $purchase->id,
                'author_payment_method_id' => $paymentMethod->id,
                'amount' => $purchase->price,
                'method' => $paymentMethod->name,
                'status' => 'pending',
                'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
            ];
        } else {
            $validated = $request->validate([
                'payment_method_id' => 'required|exists:payment_methods,id',
                'transfer_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            $paymentMethod = PaymentMethod::findOrFail($validated['payment_method_id']);

            $paymentData = [
                'user_id' => Auth::id(),
                'paymentable_type' => Purchase::class,
                'paymentable_id' => $purchase->id,
                'payment_method_id' => $paymentMethod->id,
                'amount' => $purchase->price,
                'method' => $paymentMethod->name,
                'status' => 'pending',
                'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
            ];
        }

        // Handle transfer proof upload
        if ($request->hasFile('transfer_proof')) {
            $file = $request->file('transfer_proof');
            $filename = 'transfer_proof_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('payments/transfer_proofs', $filename, 'public');
            $paymentData['transfer_proof'] = $path;
        }

        $payment = Payment::create($paymentData);

        return redirect()->route('payments.show', $payment->id)
            ->with('success', 'Silakan lanjutkan pembayaran');
    }

    /**
     * Store payment for subscription.
     * Jika langganan sudah ada payment pending, redirect ke halaman payment tersebut (cegah duplikat).
     */
    public function storeSubscriptionPayment(Request $request, $subscriptionId)
    {
        $subscription = Subscription::where('user_id', Auth::id())
            ->findOrFail($subscriptionId);

        if ($subscription->status !== 'pending') {
            return redirect()->route('subscriptions.index')
                ->with('error', 'Langganan ini sudah diproses.');
        }

        $pendingPayment = $subscription->payments()->where('status', 'pending')->first();
        if ($pendingPayment) {
            return redirect()->route('payments.show', $pendingPayment->id)
                ->with('info', 'Anda sudah memiliki pembayaran untuk langganan ini. Silakan selesaikan pembayaran.');
        }

        $validated = $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'transfer_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($validated['payment_method_id']);

        $paymentData = [
            'user_id' => Auth::id(),
            'paymentable_type' => Subscription::class,
            'paymentable_id' => $subscription->id,
            'payment_method_id' => $paymentMethod->id,
            'amount' => $subscription->amount,
            'method' => $paymentMethod->name,
            'status' => 'pending',
            'transaction_id' => 'TXN-' . strtoupper(Str::random(12)),
        ];

        // Handle transfer proof upload
        if ($request->hasFile('transfer_proof')) {
            $file = $request->file('transfer_proof');
            $filename = 'transfer_proof_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('payments/transfer_proofs', $filename, 'public');
            $paymentData['transfer_proof'] = $path;
        }

        $payment = Payment::create($paymentData);

        return redirect()->route('payments.show', $payment->id)
            ->with('success', 'Silakan lanjutkan pembayaran');
    }

    /**
     * Show payment page
     */
    public function show($id)
    {
        $payment = Payment::where('user_id', Auth::id())
            ->with(['paymentable', 'paymentMethod', 'authorPaymentMethod'])
            ->findOrFail($id);

        $paymentable = $payment->paymentable;
        if ($paymentable instanceof Purchase) {
            $paymentable->load('book');
        }

        $purchase = $paymentable instanceof Purchase ? $paymentable : null;
        $subscription = $paymentable instanceof Subscription ? $paymentable : null;

        return view('payments.show', compact('payment', 'purchase', 'subscription'));
    }

    /**
     * Generate QRIS QR code for payment (hanya untuk metode QRIS, status pending).
     * Kode QR berisi: merchant, transaction_id, jumlah (sesuai harga), dan IDR.
     */
    public function qrcode($id)
    {
        $payment = Payment::where('user_id', Auth::id())
            ->with(['paymentMethod', 'authorPaymentMethod'])
            ->findOrFail($id);

        $method = $payment->paymentMethod ?? $payment->authorPaymentMethod;
        if (!$method || $method->type !== 'qris') {
            abort(404);
        }

        if ($payment->status !== 'pending') {
            abort(404);
        }

        $amount = (int) round((float) $payment->amount);
        $payload = sprintf('QRIS|EbookStore|%s|%d|IDR', $payment->transaction_id, $amount);

        // Gunakan SimpleSoftwareIO QrCode jika terpasang; fallback ke API eksternal
        if (class_exists(\SimpleSoftwareIO\QrCode\Facades\QrCode::class)) {
            $dir = storage_path('app/temp');
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true);
            }
            $path = $dir . '/qr_' . $payment->id . '_' . time() . '.png';
            \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(300)->margin(2)->generate($payload, $path);
            $content = file_get_contents($path);
            @unlink($path);
            return response($content, 200, ['Content-Type' => 'image/png']);
        }

        return redirect('https://api.qrserver.com/v1/create-qr-code/?size=300&margin=10&data=' . urlencode($payload));
    }

    /**
     * Confirm payment (admin only or webhook)
     */
    public function confirm(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->status !== 'pending') {
            return redirect()->back()->with('error', 'Payment sudah diproses.');
        }

        $payment->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        // Update paymentable status
        if ($payment->paymentable_type === Purchase::class) {
            $purchase = $payment->paymentable;
            $purchase->update([
                'status' => 'completed',
                'purchased_at' => now(),
            ]);
        } elseif ($payment->paymentable_type === Subscription::class) {
            $subscription = $payment->paymentable;
            $subscription->update([
                'status' => 'active',
                'started_at' => now(),
                'expires_at' => $subscription->plan === 'monthly' 
                    ? now()->addMonth() 
                    : now()->addYear(),
            ]);
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    /**
     * Update transfer proof (bukti pembayaran)
     */
    public function updateTransferProof(Request $request, $id)
    {
        $payment = Payment::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($payment->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya pembayaran yang masih pending yang bisa diupdate.');
        }

        $validated = $request->validate([
            'transfer_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Delete old file if exists
        if ($payment->transfer_proof && \Storage::disk('public')->exists($payment->transfer_proof)) {
            \Storage::disk('public')->delete($payment->transfer_proof);
        }

        // Store new file
        if ($request->hasFile('transfer_proof')) {
            $file = $request->file('transfer_proof');
            $filename = 'transfer_proof_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('payments/transfer_proofs', $filename, 'public');
            
            $payment->update(['transfer_proof' => $path]);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah. Admin akan segera mengkonfirmasi.');
    }
}
