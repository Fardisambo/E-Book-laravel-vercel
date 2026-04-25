<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Nanti bisa ditambahkan data statistik buku, pembayaran, dsb
        return view('author.dashboard');
    }
}
