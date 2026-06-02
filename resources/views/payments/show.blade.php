@extends('layouts.app')

@section('title', 'Detail Payment')

@section('content')
<section class="hero-panel">
    <h1>Detail Payment</h1>
    <p>Informasi pembayaran tiket konser.</p>
</section>

<section class="ticket-card">
    <div class="ticket-head">
        <span class="badge {{ $payment->status === 'sukses' ? 'green' : ($payment->status === 'gagal' ? 'red' : 'yellow') }}">{{ ucfirst($payment->status) }}</span>
        <h3>{{ $payment->booking?->ticket?->nama_konser ?? '-' }}</h3>
        <p>{{ $payment->booking?->ticket?->nama_artis ?? '-' }}</p>
    </div>

    <div class="ticket-body">
        <div class="info-row"><span>Booking ID</span><span>#{{ $payment->booking_id }}</span></div>
        <div class="info-row"><span>Jumlah Bayar</span><span>Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</span></div>
        <div class="info-row"><span>Metode</span><span>{{ str_replace('_', ' ', $payment->metode_pembayaran) }}</span></div>
        <div class="info-row"><span>Status</span><span>{{ ucfirst($payment->status) }}</span></div>
        <div class="actions" style="margin-top:16px;">
            <a href="{{ route('payments.index') }}" class="btn btn-soft">Kembali</a>
            <a href="{{ route('riwayat.index') }}" class="btn btn-primary">Riwayat</a>
        </div>
    </div>
</section>
@endsection
