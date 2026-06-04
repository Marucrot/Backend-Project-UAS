<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingRefund;
use Illuminate\Http\Request;

class BookingRefundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login');
        }

        if (session('pengguna_role') === 'admin') {
            $refunds = BookingRefund::with(['booking.ticket', 'pengguna'])
                ->latest()
                ->get();
        } else {
            $refunds = BookingRefund::with(['booking.ticket', 'pengguna'])
                ->where('pengguna_id', session('pengguna_id'))
                ->latest()
                ->get();
        }

        return view('booking_refunds.index', compact('refunds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login');
        }

        $booking = Booking::with('ticket')->findOrFail($request->booking_id);

        $sudahAdaRefund = BookingRefund::where('booking_id', $booking->id)->exists();

        if ($sudahAdaRefund) {
            return redirect()->route('booking-refund.index')
                ->with('error', 'Refund untuk booking ini sudah pernah diajukan.');
        }

        return view('booking_refunds.create', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login');
        }

        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'alasan' => 'required|min:5',
        ]);

        $sudahAdaRefund = BookingRefund::where('booking_id', $request->booking_id)->exists();

        if ($sudahAdaRefund) {
            return redirect()->route('booking-refund.index')
                ->with('error', 'Refund untuk booking ini sudah pernah diajukan.');
        }

        BookingRefund::create([
            'booking_id' => $request->booking_id,
            'pengguna_id' => session('pengguna_id'),
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);

        return redirect()->route('booking-refund.index')
            ->with('success', 'Pengajuan refund berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingRefund $bookingRefund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingRefund $bookingRefund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingRefund $bookingRefund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingRefund $bookingRefund)
    {
        //
    }
}
