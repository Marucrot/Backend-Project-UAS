@extends('layouts.app')

@section('title', 'Edit Ticket')

@section('content')
<section class="hero-panel">
    <h1>Edit Ticket</h1>
    <p>Perbarui data tiket konser.</p>
</section>

<form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="form-card">
    @csrf
    @method('PUT')

    <div class="field">
        <label>Konser</label>
        <select name="concert_id" required>
            @foreach($concerts as $concert)
                <option value="{{ $concert->id }}" {{ $ticket->concert_id == $concert->id ? 'selected' : '' }}>
                    {{ $concert->name }} - {{ $concert->artists->pluck('name')->implode(', ') }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label>Venue</label>
        <select name="venue_id" required>
            @foreach($venues as $venue)
                <option value="{{ $venue->id }}" {{ $ticket->venue_id == $venue->id ? 'selected' : '' }}>
                    {{ $venue->nama_venue }} - {{ $venue->kota }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-2">
        <div class="field">
            <label>Tanggal Konser</label>
            <input type="date" name="tanggal_konser" value="{{ $ticket->tanggal_konser }}" required>
        </div>

        <div class="field">
            <label>Jam Konser</label>
            <input type="time" name="jam_konser" value="{{ substr($ticket->jam_konser, 0, 5) }}" required>
        </div>
    </div>

    <div class="grid grid-3">
        <div class="field">
            <label>Tipe Ticket</label>
            <select name="tipe_ticket" required>
                <option value="Regular" {{ $ticket->tipe_ticket == 'Regular' ? 'selected' : '' }}>Regular</option>
                <option value="VIP" {{ $ticket->tipe_ticket == 'VIP' ? 'selected' : '' }}>VIP</option>
            </select>
        </div>

        <div class="field">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $ticket->harga }}" required>
        </div>

        <div class="field">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ $ticket->stock }}" required>
        </div>
    </div>

    <div class="actions">
        <button type="submit" class="btn btn-primary">Update Ticket</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-soft">Kembali</a>
    </div>
</form>
@endsection
