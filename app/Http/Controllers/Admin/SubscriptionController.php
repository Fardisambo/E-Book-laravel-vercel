<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
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
     * Display a listing of subscriptions
     */
    public function index(Request $request)
    {
        $plans = SubscriptionPlan::orderByRaw("FIELD(plan, 'monthly', 'yearly')")->get();

        // allow admin to search/filter and adjust per-page limit
        $query = Subscription::with('user')->latest();

        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $perPage = (int) $request->input('per_page', 20);
        if ($perPage <= 0) {
            $perPage = 20;
        }

        $subscriptions = $query->paginate($perPage)
            ->appends($request->only(['user', 'status', 'per_page']));

        return view('admin.subscriptions.index', compact('subscriptions', 'plans'));
    }

    public function updatePlans(Request $request)
    {
        $validated = $request->validate([
            'plans.monthly.price' => 'required|numeric|min:0',
            'plans.monthly.description' => 'nullable|string|max:1000',
            'plans.yearly.price' => 'required|numeric|min:0',
            'plans.yearly.description' => 'nullable|string|max:1000',
        ]);

        foreach (['monthly', 'yearly'] as $planType) {
            SubscriptionPlan::updateOrCreate(
                ['plan' => $planType],
                [
                    'price' => $validated['plans'][$planType]['price'],
                    'description' => $validated['plans'][$planType]['description'] ?? null,
                ]
            );
        }

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('success', 'Pengaturan paket langganan berhasil diperbarui.');
    }

    /**
     * Show the form for creating a new subscription
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.subscriptions.create', compact('users'));
    }

    /**
     * Store a newly created subscription in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|in:monthly,yearly',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,active,expired,cancelled',
            'started_at' => 'required|date',
            'expires_at' => 'required|date|after:started_at',
        ]);

        Subscription::create($validated);

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('success', 'Langganan berhasil dibuat');
    }

    /**
     * Display the specified subscription
     */
    public function show($id)
    {
        $subscription = Subscription::with(['user', 'payments.paymentMethod'])
            ->findOrFail($id);

        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription
     */
    public function edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        $users = User::orderBy('name')->get();
        return view('admin.subscriptions.edit', compact('subscription', 'users'));
    }

    /**
     * Update the specified subscription in storage
     */
    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan' => 'required|in:monthly,yearly',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,active,expired,cancelled',
            'started_at' => 'required|date',
            'expires_at' => 'required|date|after:started_at',
        ]);

        $subscription->update($validated);

        return redirect()
            ->route('admin.subscriptions.show', $subscription->id)
            ->with('success', 'Langganan berhasil diperbarui');
    }

    /**
     * Remove the specified subscription from storage
     */
    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        
        $subscription->delete();

        return redirect()
            ->route('admin.subscriptions.index')
            ->with('success', 'Langganan berhasil dihapus');
    }

    /**
     * Update subscription status
     */
    public function updateStatus(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,active,expired,cancelled',
        ]);

        $subscription->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Status langganan berhasil diperbarui');
    }
}
