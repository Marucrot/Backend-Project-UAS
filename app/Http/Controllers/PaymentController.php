<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        Payment::create([
            'booking_id'        => $request->booking_id,
            'user_id'           => $request->user_id,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status'            => $request->status,
        ]);

        return redirect('/payments');
    }

    public function show(string $id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.show', compact('payment'));
    }

    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'booking_id'        => $request->booking_id,
            'user_id'           => $request->user_id,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status'            => $request->status,
        ]);

        return redirect('/payments');
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect('/payments');
    }
}
