@extends('layouts.app')

@section('title', 'Daftar Ticket')

@section('content')
<section class="hero-panel">
    <h1>Ticket Konser</h1>
    <p>Daftar tiket berdasarkan konser, artis, venue, kategori, harga, dan stok.</p>
</section>

<section class="content-card">
    <div class="section-head">
        <div>
            <h2>Semua Ticket</h2>
            <p class="muted" style="margin:6px 0 0;">Admin dapat menambah, mengedit, dan menghapus tiket.</p>
        </div>
        <div class="actions">
            <a href="{{ route('home') }}" class="btn btn-soft">Home</a>
            @if(session('pengguna_role') === 'admin')
                <a href="{{ route('tickets.create') }}" class="btn btn-primary">+ Tambah Ticket</a>
            @endif
        </div>
    </div>

    <div class="grid grid-3">
        @forelse($tickets as $ticket)
            <div class="ticket-card">
                <div class="ticket-head">
                    <span class="badge {{ $ticket->stock > 0 ? 'green' : 'red' }}">{{ $ticket->stock > 0 ? 'Tersedia' : 'Sold Out' }}</span>
                    <h3>{{ $ticket->nama_konser }}</h3>
                    <p>{{ $ticket->nama_artis }}</p>
                </div>

                <div class="ticket-body">
                    <div class="info-row"><span>Venue</span><span>{{ $ticket->venue?->nama_venue ?? '-' }}</span></div>
                    <div class="info-row"><span>Tanggal</span><span>{{ \Carbon\Carbon::parse($ticket->tanggal_konser)->format('d M Y') }}</span></div>
                    <div class="info-row"><span>Jam</span><span>{{ substr($ticket->jam_konser, 0, 5) }} WIB</span></div>
                    <div class="info-row"><span>Tipe</span><span>{{ $ticket->tipe_ticket }}</span></div>
                    <div class="info-row"><span>Harga</span><span>Rp{{ number_format($ticket->harga, 0, ',', '.') }}</span></div>
                    <div class="info-row"><span>Stock</span><span>{{ $ticket->stock }}</span></div>

                    <div class="actions" style="margin-top:16px;">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-soft">Detail</a>
                        <a href="{{ route('booking.create') }}" class="btn btn-primary">Booking</a>
                        @if ($ticket->concert_id)
                            <form action="{{ route('wishlist.store') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="concert_id" value="{{ $ticket->concert_id }}">
                                <button type="submit">♡ Wishlist</button>
                            </form>
                        @endif
                        @if(session('pengguna_role') === 'admin')
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-dark">Edit</a>
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Hapus tiket ini?')">Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">Belum ada data tiket.</div>
        @endforelse
    </div>
</section>
@endsection
