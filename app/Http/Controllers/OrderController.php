<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display unpaid orders (pending)
     */
    public function unpaid(): View
    {
        return view('orders.unpaid');
    }

    /**
     * Display paid orders (completed/active)
     */
    public function paid(): View
    {
        return view('orders.paid');
    }
}
