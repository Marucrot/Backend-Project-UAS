<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Payment::with(['booking.ticket.venue'])->latest();

        if (session('pengguna_role') !== 'admin') {
            $query->whereHas('booking', function ($booking) {
                $booking->where('user_id', session('pengguna_id'));
            });
        }

        $payments = $query->get();

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login')->with('error', 'Login dulu sebelum melakukan pembayaran.');
        }

        $bookingId = $request->query('booking_id');
        $booking = Booking::with(['ticket.venue'])->findOrFail($bookingId);

        if (session('pengguna_role') !== 'admin' && $booking->user_id !== session('pengguna_id')) {
            abort(403);
        }

        return view('payments.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login')->with('error', 'Login dulu sebelum melakukan pembayaran.');
        }

        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required|in:transfer,kartu_kredit,e_wallet',
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);

        if (session('pengguna_role') !== 'admin' && $booking->user_id !== session('pengguna_id')) {
            abort(403);
        }

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'jumlah_bayar' => $booking->total_harga,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'status' => 'sukses',
        ]);

        $booking->update(['status' => 'paid']);

        return redirect()->route('payments.show', $payment->id)->with('success', 'Pembayaran berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with(['booking.ticket.venue'])->findOrFail($id);

        if (session('pengguna_role') !== 'admin' && $payment->booking->user_id !== session('pengguna_id')) {
            abort(403);
        }

        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (session('pengguna_role') !== 'admin') {
            return redirect()->route('payments.index')->with('error', 'Edit pembayaran hanya untuk admin.');
        }

        $payment = Payment::findOrFail($id);

        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (session('pengguna_role') !== 'admin') {
            return redirect()->route('payments.index')->with('error', 'Update pembayaran hanya untuk admin.');
        }

        $validated = $request->validate([
            'metode_pembayaran' => 'required|in:transfer,kartu_kredit,e_wallet',
            'status' => 'required|in:pending,sukses,gagal',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (session('pengguna_role') !== 'admin') {
            return redirect()->route('payments.index')->with('error', 'Hapus pembayaran hanya untuk admin.');
        }

        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
