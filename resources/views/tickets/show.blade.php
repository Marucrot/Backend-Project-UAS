@extends('layouts.app')

@section('title', 'Detail Ticket')

@section('content')
<section class="hero-panel">
    <h1>Detail Ticket</h1>
    <p>Informasi lengkap tiket dan kategori lain dalam konser yang sama.</p>
</section>

<section class="ticket-card" style="margin-bottom:24px;">
    <div class="ticket-head">
        <span class="badge {{ $ticket->stock > 0 ? 'green' : 'red' }}">{{ $ticket->stock > 0 ? 'Tersedia' : 'Sold Out' }}</span>
        <h3>{{ $ticket->nama_konser }}</h3>
        <p>{{ $ticket->nama_artis }}</p>
    </div>

    <div class="ticket-body">
        <div class="info-row"><span>Venue</span><span>{{ $ticket->venue?->nama_venue ?? '-' }}</span></div>
        <div class="info-row"><span>Kota</span><span>{{ $ticket->venue?->kota ?? '-' }}</span></div>
        <div class="info-row"><span>Tanggal</span><span>{{ \Carbon\Carbon::parse($ticket->tanggal_konser)->format('d M Y') }}</span></div>
        <div class="info-row"><span>Jam</span><span>{{ substr($ticket->jam_konser, 0, 5) }} WIB</span></div>
        <div class="info-row"><span>Tipe</span><span>{{ $ticket->tipe_ticket }}</span></div>
        <div class="info-row"><span>Harga</span><span>Rp{{ number_format($ticket->harga, 0, ',', '.') }}</span></div>
        <div class="info-row"><span>Stock</span><span>{{ $ticket->stock }}</span></div>

        <div class="actions" style="margin-top:16px;">
            <a href="{{ route('booking.create') }}" class="btn btn-primary">Booking</a>
            <a href="{{ route('tickets.index') }}" class="btn btn-soft">Kembali</a>
        </div>
    </div>
</section>

<section class="content-card">
    <div class="section-head">
        <h2>Kategori Tiket Konser Ini</h2>
    </div>

    <div class="table-wrap">
        <table>
            <tr>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Status</th>
            </tr>
            @forelse($relatedTickets as $item)
                <tr>
                    <td>{{ $item->tipe_ticket }}</td>
                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ $item->stock > 0 ? 'Tersedia' : 'Sold Out' }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada kategori lain.</td></tr>
            @endforelse
        </table>
    </div>
</section>
@endsection
