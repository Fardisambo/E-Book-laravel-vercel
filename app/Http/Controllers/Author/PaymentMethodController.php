<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\AuthorPaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = AuthorPaymentMethod::where('user_id', Auth::id())->get();
        return view('author.payment_methods.index', compact('methods'));
    }

    public function create()
    {
        return view('author.payment_methods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'account_number' => 'required|string|max:100',
            'account_name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
        ]);
        AuthorPaymentMethod::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'account_number' => $validated['account_number'],
            'account_name' => $validated['account_name'],
            'type' => $validated['type'],
        ]);
        return redirect()->route('author.payment-methods.index')->with('success', 'Metode pembayaran berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $method = AuthorPaymentMethod::where('user_id', Auth::id())->findOrFail($id);
        return view('author.payment_methods.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $method = AuthorPaymentMethod::where('user_id', Auth::id())->findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'account_number' => 'required|string|max:100',
            'account_name' => 'required|string|max:100',
            'type' => 'required|string|max:50',
            'is_active' => 'sometimes|boolean',
        ]);
        $method->update($validated);
        return redirect()->route('author.payment-methods.index')->with('success', 'Metode pembayaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $method = AuthorPaymentMethod::where('user_id', Auth::id())->findOrFail($id);
        $method->delete();
        return redirect()->route('author.payment-methods.index')->with('success', 'Metode pembayaran berhasil dihapus!');
    }
}
