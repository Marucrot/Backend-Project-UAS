@extends('layouts.app')

@section('title', 'Buat Booking')

@section('content')
<section class="hero-panel">
    <h1>Buat Booking</h1>
    <p>Pilih tiket konser dan masukkan jumlah tiket yang ingin dipesan.</p>
</section>

<form action="{{ route('booking.store') }}" method="POST" class="form-card">
    @csrf

    <div class="field">
        <label>Pilih Ticket</label>
        <select name="ticket_id" required>
            <option value="">Pilih ticket</option>
            @foreach($tickets as $ticket)
                <option value="{{ $ticket->id }}">
                    {{ $ticket->nama_konser }} - {{ $ticket->nama_artis }} - {{ $ticket->venue?->nama_venue }} - {{ $ticket->tipe_ticket }} - Rp{{ number_format($ticket->harga, 0, ',', '.') }} - Stok {{ $ticket->stock }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label>Jumlah Tiket</label>
        <input type="number" name="kuantitas" min="1" placeholder="Masukkan jumlah tiket" required>
    </div>

    <div class="actions">
        <button type="submit" class="btn btn-primary">Booking Sekarang</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-soft">Lihat Ticket</a>
    </div>
</form>
@endsection
