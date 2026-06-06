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

    public function approve($id)
    {
        if (session('pengguna_role') !== 'admin') {
            return redirect()->back()->with('error', 'Akses hanya untuk admin.');
        }

        $refund = BookingRefund::with('booking')->findOrFail($id);

        $refund->update([
            'status' => 'approved',
            'catatan_admin' => 'Refund disetujui oleh admin.',
        ]);

        if ($refund->booking) {
            $refund->booking->update([
                'status' => 'refunded',
            ]);
        }

        return redirect()->back()->with('success', 'Refund berhasil disetujui.');
    }

    public function reject($id)
    {
        if (session('pengguna_role') !== 'admin') {
            return redirect()->back()->with('error', 'Akses hanya untuk admin.');
        }

        $refund = BookingRefund::findOrFail($id);

        $refund->update([
            'status' => 'rejected',
            'catatan_admin' => 'Refund ditolak oleh admin.',
        ]);

        return redirect()->back()->with('success', 'Refund berhasil ditolak.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login');
        }

        $refund = BookingRefund::where('id', $id)
            ->where('pengguna_id', session('pengguna_id'))
            ->firstOrFail();

        if ($refund->status !== 'pending') {
            return redirect()->back()->with('error', 'Refund yang sudah diproses tidak bisa dibatalkan.');
        }

        $refund->delete();

        return redirect()->back()->with('success', 'Pengajuan refund berhasil dibatalkan.');
    }
}
