<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show subscription plans
     */
    public function index()
    {
        $user = Auth::user();
        $plans = SubscriptionPlan::whereIn('plan', ['monthly', 'yearly'])->get()->keyBy('plan');
        $activeSubscription = $user->activeSubscription;
        $pendingSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->first();

        $pendingPayment = $pendingSubscription
            ? $pendingSubscription->payments()->where('status', 'pending')->first()
            : null;

        return view('subscriptions.index', compact('activeSubscription', 'pendingSubscription', 'pendingPayment', 'plans'));
    }

    /**
     * Create subscription.
     * Jika user sudah punya langganan status 'pending' (belum dibayar), redirect ke halaman
     * pembayaran yang ada agar tidak terjadi duplikasi data.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:monthly,yearly',
        ]);

        $pendingSubscription = Subscription::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($pendingSubscription) {
            $pendingPayment = $pendingSubscription->payments()->where('status', 'pending')->first();
            if ($pendingPayment) {
                return redirect()->route('payments.show', $pendingPayment->id)
                    ->with('info', 'Anda memiliki pembayaran langganan yang menunggu. Silakan selesaikan pembayaran ini.');
            }
            return redirect()->route('payments.create-subscription', $pendingSubscription->id)
                ->with('info', 'Anda memiliki langganan yang belum dibayar. Silakan selesaikan pembayaran.');
        }

        $planSetting = SubscriptionPlan::where('plan', $request->plan)->first();
        $defaultAmount = $request->plan === 'monthly' ? 50000 : 500000;
        $amount = $planSetting?->price ?? $defaultAmount;

        $subscription = Subscription::create([
            'user_id' => Auth::id(),
            'plan' => $request->plan,
            'amount' => $amount,
            'status' => 'pending',
            'started_at' => now(),
            'expires_at' => $request->plan === 'monthly'
                ? now()->addMonth()
                : now()->addYear(),
        ]);

        return redirect()->route('payments.create-subscription', $subscription->id)
            ->with('success', 'Silakan lakukan pembayaran untuk mengaktifkan langganan.');
    }

    /**
     * Cancel subscription
     */
    public function cancel($id)
    {
        $subscription = Subscription::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($subscription->status !== 'active') {
            return redirect()->back()->with('error', 'Langganan tidak aktif.');
        }

        $subscription->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Langganan berhasil dibatalkan.');
    }
}
