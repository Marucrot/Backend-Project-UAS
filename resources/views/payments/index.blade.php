@extends('layouts.app')

@section('title', 'Data Payment')

@section('content')
<section class="hero-panel">
    <h1>Payment</h1>
    <p>Data pembayaran tiket yang sudah dibuat.</p>
</section>

<section class="content-card">
    <div class="section-head">
        <h2>Daftar Payment</h2>
        <a href="{{ route('booking.index') }}" class="btn btn-soft">Data Booking</a>
    </div>

    <div class="table-wrap">
        <table>
            <tr>
                <th>Booking</th>
                <th>Konser</th>
                <th>Jumlah Bayar</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @forelse($payments as $payment)
                <tr>
                    <td>#{{ $payment->booking_id }}</td>
                    <td>{{ $payment->booking?->ticket?->nama_konser ?? '-' }}</td>
                    <td>Rp{{ number_format($payment->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>{{ str_replace('_', ' ', $payment->metode_pembayaran) }}</td>
                    <td><span class="badge {{ $payment->status === 'sukses' ? 'green' : ($payment->status === 'gagal' ? 'red' : 'yellow') }}">{{ ucfirst($payment->status) }}</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-soft">Detail</a>
                            @if(session('pengguna_role') === 'admin')
                                <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-dark">Edit</a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada pembayaran.</td></tr>
            @endforelse
        </table>
    </div>
</section>
@endsection
