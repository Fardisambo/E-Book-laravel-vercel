<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $baseQuery = Payment::where('paymentable_type', Purchase::class)
            ->whereHas('paymentable.book', function ($query) {
                $query->where('user_id', Auth::id());
            });

        $totalCompleted = (clone $baseQuery)->where('status', 'completed')->sum('amount');
        $totalPending = (clone $baseQuery)->where('status', 'pending')->count();
        $totalSales = (clone $baseQuery)->count();

        $payments = $baseQuery->with(['paymentable.book', 'user', 'paymentMethod', 'authorPaymentMethod'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('author.payments.index', compact('payments', 'totalCompleted', 'totalPending', 'totalSales'));
    }

    public function show($id)
    {
        $payment = Payment::where('id', $id)
            ->where('paymentable_type', Purchase::class)
            ->whereHas('paymentable.book', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['paymentable.book', 'user', 'paymentMethod', 'authorPaymentMethod'])
            ->firstOrFail();

        return view('author.payments.show', compact('payment'));
    }
}
