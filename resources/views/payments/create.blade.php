@extends('layouts.app')

@section('title', 'Bayar Booking')

@section('content')
<section class="hero-panel">
    <h1>Bayar Booking</h1>
    <p>Pilih metode pembayaran untuk menyelesaikan booking.</p>
</section>

<section class="ticket-card" style="margin-bottom:24px;">
    <div class="ticket-head">
        <span class="badge yellow">Pending</span>
        <h3>{{ $booking->ticket?->nama_konser ?? '-' }}</h3>
        <p>{{ $booking->ticket?->nama_artis ?? '-' }}</p>
    </div>
    <div class="ticket-body">
        <div class="info-row"><span>Jumlah Tiket</span><span>{{ $booking->kuantitas }}</span></div>
        <div class="info-row"><span>Total Bayar</span><span>Rp{{ number_format($booking->total_harga, 0, ',', '.') }}</span></div>
    </div>
</section>

<form action="{{ route('payments.store') }}" method="POST" class="form-card">
    @csrf
    <input type="hidden" name="booking_id" value="{{ $booking->id }}">

    <div class="field">
        <label>Metode Pembayaran</label>
        <select name="metode_pembayaran" required>
            <option value="transfer">Transfer Bank</option>
            <option value="e_wallet">E-Wallet</option>
            <option value="kartu_kredit">Kartu Kredit</option>
        </select>
    </div>

    <div class="actions">
        <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
        <a href="{{ route('booking.index') }}" class="btn btn-soft">Kembali</a>
    </div>
</form>
@endsection
