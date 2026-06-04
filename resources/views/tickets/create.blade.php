@extends('layouts.app')

@section('title', 'Tambah Ticket')

@section('content')
<section class="hero-panel">
    <h1>Tambah Ticket</h1>
    <p>Ticket dibuat dari data konser dan venue yang sudah tersedia.</p>
</section>

<form action="{{ route('tickets.store') }}" method="POST" class="form-card">
    @csrf

    <div class="field">
        <label>Konser</label>
        <select name="concert_id" required>
            <option value="">Pilih konser</option>
            @foreach($concerts as $concert)
                <option value="{{ $concert->id }}">
                    {{ $concert->name }} - {{ $concert->artists->pluck('name')->implode(', ') }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="field">
        <label>Venue</label>
        <select name="venue_id" required>
            <option value="">Pilih venue</option>
            @foreach($venues as $venue)
                <option value="{{ $venue->id }}">{{ $venue->nama_venue }} - {{ $venue->kota }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-2">
        <div class="field">
            <label>Tanggal Konser</label>
            <input type="date" name="tanggal_konser" required>
        </div>

        <div class="field">
            <label>Jam Konser</label>
            <input type="time" name="jam_konser" required>
        </div>
    </div>

    <div class="grid grid-3">
        <div class="field">
            <label>Tipe Ticket</label>
            <select name="tipe_ticket" required>
                <option value="Regular">Regular</option>
                <option value="VIP">VIP</option>
            </select>
        </div>

        <div class="field">
            <label>Harga</label>
            <input type="number" name="harga" placeholder="Contoh 1000000" required>
        </div>

        <div class="field">
            <label>Stock</label>
            <input type="number" name="stock" placeholder="Contoh 100" required>
        </div>
    </div>

    <div class="actions">
        <button type="submit" class="btn btn-primary">Simpan Ticket</button>
        <a href="{{ route('tickets.index') }}" class="btn btn-soft">Kembali</a>
    </div>
</form>
@endsection
