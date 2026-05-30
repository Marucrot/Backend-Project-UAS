<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_details = PaymentDetail::all();
        return view('payment_details.index', compact('payment_details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $payment_id = $request->query('payment_id');
        $payment = $payment_id ? Payment::findOrFail($payment_id) : null;
        return view('payment_details.create', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PaymentDetail::create([
            'payment_id' => $request->payment_id,
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_pengirim' => $request->nama_pengirim,
        ]);

        return redirect('/payment-details/' . $request->payment_id . '/show-by-payment');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment_detail = PaymentDetail::findOrFail($id);
        return view('payment_details.show', compact('payment_detail'));
    }


    public function showByPayment(string $payment_id)
    {
        $payment_detail = PaymentDetail::where('payment_id', $payment_id)->firstOrFail();
        return view('payment_details.show', compact('payment_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment_detail = PaymentDetail::findOrFail($id);
        return view('payment_details.edit', compact('payment_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment_detail = PaymentDetail::findOrFail($id);
        $payment_detail->update([
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'nama_pengirim' => $request->nama_pengirim,
        ]);

        return redirect('/payment-details');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment_detail = PaymentDetail::findOrFail($id);
        $payment_detail->delete();

        return redirect('/payment-details');
    }
}
