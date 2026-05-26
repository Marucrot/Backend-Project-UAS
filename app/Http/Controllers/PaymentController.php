<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Tampilkan semua data pembayaran.
     */
    public function index()
    {
        $payments = Payment::with(['booking'])->latest()->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Tampilkan form pembayaran untuk booking tertentu.
     */
    public function create(Request $request)
    {
        $booking_id = $request->query('booking_id');
        $booking = $booking_id ? Booking::with('ticket')->findOrFail($booking_id) : null;

        // Cek apakah booking sudah punya payment
        if ($booking && $booking->payment) {
            return redirect()->route('payments.show', $booking->payment->id)
                ->with('info', 'Booking ini sudah memiliki data pembayaran.');
        }

        return view('payments.create', compact('booking'));
    }

    /**
     * Simpan data pembayaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id'         => 'required|exists:bookings,id',
            'metode_pembayaran'  => 'required|in:transfer,kartu_kredit,e_wallet',
            'bukti_pembayaran'   => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Upload bukti pembayaran jika ada
        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $payment = Payment::create([
            'booking_id'        => $booking->id,
            'user_id'           => $booking->user_id,
            'jumlah_bayar'      => $booking->total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status'            => 'pending',
            'bukti_pembayaran'  => $buktiPath,
            'tanggal_bayar'     => now(),
        ]);

        // Update status booking menjadi paid
        $booking->update(['status' => 'paid']);

        return redirect()->route('payments.show', $payment->id)
            ->with('success', 'Pembayaran berhasil disimpan. Menunggu konfirmasi.');
    }

    /**
     * Tampilkan detail pembayaran.
     */
    public function show(string $id)
    {
        $payment = Payment::with(['booking.ticket'])->findOrFail($id);
        return view('payments.show', compact('payment'));
    }

    /**
     * Tampilkan form edit pembayaran.
     */
    public function edit(string $id)
    {
        $payment = Payment::with('booking')->findOrFail($id);
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update status atau data pembayaran.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status'             => 'required|in:pending,sukses,gagal',
            'metode_pembayaran'  => 'required|in:transfer,kartu_kredit,e_wallet',
            'bukti_pembayaran'   => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $payment = Payment::findOrFail($id);

        // Upload bukti baru jika ada
        if ($request->hasFile('bukti_pembayaran')) {
            // Hapus file lama
            if ($payment->bukti_pembayaran) {
                Storage::disk('public')->delete($payment->bukti_pembayaran);
            }
            $payment->bukti_pembayaran = $request->file('bukti_pembayaran')
                ->store('bukti_pembayaran', 'public');
        }

        $payment->metode_pembayaran = $request->metode_pembayaran;
        $payment->status            = $request->status;
        $payment->save();

        // Sinkronisasi status booking
        if ($request->status === 'sukses') {
            $payment->booking->update(['status' => 'confirmed']);
        } elseif ($request->status === 'gagal') {
            $payment->booking->update(['status' => 'cancelled']);
        }

        return redirect()->route('payments.show', $payment->id)
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    /**
     * Hapus data pembayaran.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);

        if ($payment->bukti_pembayaran) {
            Storage::disk('public')->delete($payment->bukti_pembayaran);
        }

        // Kembalikan status booking ke pending
        $payment->booking->update(['status' => 'pending']);

        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
