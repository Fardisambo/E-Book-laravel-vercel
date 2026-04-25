<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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
     * Display admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_books' => Book::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_categories' => Category::count(),
            'total_purchases' => Purchase::where('status', 'completed')->count(),
            'total_subscriptions' => Subscription::where('status', 'active')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'pending_payments' => Payment::where('status', 'pending')->count(),
        ];

        $recentBooks = Book::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();
        $recentPayments = Payment::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentBooks', 'recentUsers', 'recentPayments'));
    }
}
