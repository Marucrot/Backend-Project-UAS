@extends('layouts.app')

@section('title', 'Booking Tiket')

@section('content')
<section class="hero-panel">
    <h1>Booking Tiket</h1>
    <p>Daftar booking tiket konser yang sudah dibuat.</p>
</section>

<section class="content-card">
    <div class="section-head">
        <div>
            <h2>Data Booking</h2>
            <p class="muted" style="margin:6px 0 0;">User melihat booking miliknya, admin melihat semua booking.</p>
        </div>
        <a href="{{ route('booking.create') }}" class="btn btn-primary">+ Booking Tiket</a>
    </div>

    <div class="grid grid-2">
        @forelse($booking as $item)
            <div class="ticket-card">
                <div class="ticket-head">
                    <span class="badge {{ $item->status === 'paid' ? 'green' : 'yellow' }}">{{ ucfirst($item->status) }}</span>
                    <h3>{{ $item->ticket?->nama_konser ?? '-' }}</h3>
                    <p>{{ $item->ticket?->nama_artis ?? '-' }}</p>
                </div>
                <div class="ticket-body">
                    <div class="info-row"><span>Venue</span><span>{{ $item->ticket?->venue?->nama_venue ?? '-' }}</span></div>
                    <div class="info-row"><span>Tipe Ticket</span><span>{{ $item->ticket?->tipe_ticket ?? '-' }}</span></div>
                    <div class="info-row"><span>Jumlah</span><span>{{ $item->kuantitas }} tiket</span></div>
                    <div class="info-row"><span>Total</span><span>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</span></div>
                    <div class="actions" style="margin-top:16px;">
                        <a href="{{ route('booking.show', $item->id) }}" class="btn btn-soft">Detail</a>
                        @if($item->status === 'pending')
                            <a href="{{ route('payments.create', ['booking_id' => $item->id]) }}" class="btn btn-primary">Bayar</a>
                        @else
                            <span class="badge green">Sudah Dibayar</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">Belum ada booking.</div>
        @endforelse
    </div>
</section>
@endsection
