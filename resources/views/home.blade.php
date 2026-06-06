@extends('layouts.app')

@section('title', 'BeatMeet Home')

@section('content')
@php
    $daftarKonser = $concerts ?? collect();

    $slr = $daftarKonser->firstWhere('name', 'Sukses Lancar Rejeki Live');
    $ado = $daftarKonser->firstWhere('name', 'Ado World Tour');
    $feast = $daftarKonser->firstWhere('name', '.Feast Selamat Datang Tour');
    $bruno = $daftarKonser->firstWhere('name', 'Bruno Mars Live in Jakarta');
    $dewa = $daftarKonser->firstWhere('name', 'Dewa 19 All Stars');
@endphp

<style>
    .home-page {
        min-height: calc(100vh - 70px);
        background: radial-gradient(circle at center, #4b5f9a 0%, #2d3d63 45%, #17243b 100%);
        padding: 80px 0 160px;
    }

    .main-banner {
        width: 84%;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 260px;
    }

    .main-banner-image {
        width: 46%;
        height: 250px;
        background: #2a375c;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .main-banner-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        display: block;
        filter: grayscale(100%);
    }

    .main-banner-text {
        width: 54%;
        min-height: 250px;
        padding: 40px;
        color: white;
        background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
        background-size: 8px 8px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .main-banner-text h1 {
        margin: 0 0 16px;
        font-size: 48px;
        line-height: 1;
        font-weight: bold;
    }

    .main-banner-text p {
        margin: 3px 0;
        font-size: 18px;
        font-weight: bold;
    }

    .order-btn {
        display: inline-block;
        width: fit-content;
        margin-top: 16px;
        padding: 10px 18px;
        background: #ef4765;
        color: white;
        text-decoration: none;
        border-radius: 14px;
        font-size: 15px;
        border: none;
    }

    .order-btn:hover {
        background: #d93d58;
    }

    .menu-section {
        width: 50%;
        margin: 85px auto 0;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 16px;
    }

    .menu-card {
        background: white;
        border: 1px solid #d7def0;
        border-radius: 12px;
        padding: 18px;
        min-height: 140px;
    }

    .menu-card h3 {
        margin: 0 0 10px;
        color: #111827;
        font-size: 20px;
    }

    .menu-card p {
        margin: 0 0 16px;
        color: #5c6680;
        font-size: 14px;
        line-height: 1.5;
    }

    .menu-card a {
        display: inline-block;
        padding: 8px 14px;
        border: 1px solid #b7c7f0;
        background: #eef3ff;
        color: #0f234a;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
    }

    .concert-section {
        width: 50%;
        margin: 30px auto 100px;
    }

    .concert-section h2 {
        margin: 0;
        color: white;
        font-size: 24px;
    }

    .concert-section p {
        margin: 6px 0 18px;
        color: white;
        font-size: 14px;
    }

    .concert-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }

    .concert-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #d7def0;
    }

    .concert-card img {
        width: 100%;
        height: 150px;
        object-fit: contain;
        object-position: center;
        display: block;
        background: #ffffff;
    }

    .concert-card-body {
        padding: 14px;
    }

    .concert-card-body h3 {
        margin: 0 0 6px;
        font-size: 18px;
        color: #111827;
    }

    .concert-card-body p {
        color: #5c6680;
        margin: 0 0 8px;
        font-size: 13px;
    }

    .concert-card-body a {
        color: #ef4765;
        text-decoration: none;
        font-size: 14px;
        font-weight: bold;
        margin-right: 8px;
    }

    .highlight-card {
        border: 2px solid #ef4765;
    }

    .wishlist-form {
        margin-top: 10px;
    }

    .wishlist-btn {
        background: white;
        border: 1px solid #ef4765;
        color: #ef4765;
        padding: 8px 12px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 14px;
    }

    .wishlist-btn:hover {
        background: #ef4765;
        color: white;
    }

    @media (max-width: 1100px) {
        .menu-section,
        .concert-section {
            width: 84%;
        }

        .menu-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 900px) {
        .home-page {
            padding: 40px 0 120px;
        }

        .main-banner {
            width: 92%;
            flex-direction: column;
        }

        .main-banner-image,
        .main-banner-text {
            width: 100%;
        }

        .main-banner-text h1 {
            font-size: 38px;
        }

        .menu-section {
            width: 92%;
            grid-template-columns: 1fr;
        }

        .concert-section {
            width: 92%;
        }

        .concert-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="home-page">
    <div class="main-banner">
        <div class="main-banner-image">
            <img src="{{ asset($slr?->poster_url ?? 'resource/image/slr.jpg') }}" alt="Sukses Lancar Rejeki">
        </div>

        <div class="main-banner-text">
            <h1>Sukses Lancar<br>Rejeki</h1>
            <p>Lokasi : GBK</p>
            <p>Waktu : 20:00</p>
            <a href="{{ route('booking.index') }}" class="order-btn">Order Now!</a>
        </div>
    </div>

    <div class="menu-section">
        <div class="menu-card">
            <h3>Schedule</h3>
            <p>Lihat jadwal konser, venue, jam mulai, dan status tiket.</p>
            <a href="{{ route('schedule.index') }}">Buka</a>
        </div>

        <div class="menu-card">
            <h3>Ticket</h3>
            <p>Pilih kategori tiket reguler, festival, atau VIP.</p>
            <a href="{{ route('tickets.index') }}">Buka</a>
        </div>

        <div class="menu-card">
            <h3>Booking</h3>
            <p>Buat pemesanan tiket untuk konser yang kamu pilih.</p>
            <a href="{{ route('booking.index') }}">Buka</a>
        </div>

        <div class="menu-card">
            <h3>History</h3>
            <p>Cek riwayat pemesanan dan status tiket kamu.</p>
            <a href="{{ route('riwayat.index') }}">Buka</a>
        </div>

        <div class="menu-card">
            <h3>Wishlist</h3>
            <p>Lihat konser yang sudah kamu favoritkan.</p>
            <a href="{{ route('wishlist.index') }}">Buka</a>
        </div>
    </div>

    <div class="concert-section">
        <h2>Konser Pilihan</h2>
        <p>Pilih konser favorit kamu, lalu simpan ke wishlist.</p>

        <div class="concert-grid">
            <div class="concert-card">
                <img src="{{ asset($slr?->poster_url ?? 'resource/image/slr.jpg') }}" alt="Sukses Lancar Rejeki">

                <div class="concert-card-body">
                    <h3>Sukses Lancar Rejeki</h3>
                    <p>Venue: GBK</p>
                    <a href="{{ route('schedule.index') }}">Lihat Schedule</a>

                    @if ($slr)
                        <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form">
                            @csrf
                            <input type="hidden" name="concert_id" value="{{ $slr->id }}">
                            <button type="submit" class="wishlist-btn">♡ Wishlist</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="concert-card">
                <img src="{{ asset($ado?->poster_url ?? 'resource/image/ado.jpg') }}" alt="Ado">

                <div class="concert-card-body">
                    <h3>Ado</h3>
                    <p>Venue: Kasablanka Hall</p>
                    <a href="{{ route('schedule.index') }}">Lihat Schedule</a>

                    @if ($ado)
                        <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form">
                            @csrf
                            <input type="hidden" name="concert_id" value="{{ $ado->id }}">
                            <button type="submit" class="wishlist-btn">♡ Wishlist</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="concert-card">
                <img src="{{ asset($feast?->poster_url ?? 'resource/image/feast.jpg') }}" alt=".Feast">

                <div class="concert-card-body">
                    <h3>.Feast</h3>
                    <p>Venue: GBK</p>
                    <a href="{{ route('schedule.index') }}">Lihat Schedule</a>

                    @if ($feast)
                        <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form">
                            @csrf
                            <input type="hidden" name="concert_id" value="{{ $feast->id }}">
                            <button type="submit" class="wishlist-btn">♡ Wishlist</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="concert-card highlight-card">
                <img src="{{ asset($bruno?->poster_url ?? 'resource/image/bruno.jpg') }}" alt="Bruno Mars">

                <div class="concert-card-body">
                    <h3>Bruno Mars</h3>
                    <p>Venue: JIS</p>
                    <a href="{{ route('schedule.index') }}">Lihat Schedule</a>

                    @if ($bruno)
                        <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form">
                            @csrf
                            <input type="hidden" name="concert_id" value="{{ $bruno->id }}">
                            <button type="submit" class="wishlist-btn">♡ Wishlist</button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="concert-card">
                <img src="{{ asset($dewa?->poster_url ?? 'resource/image/dewa19.jpg') }}" alt="Dewa 19">

                <div class="concert-card-body">
                    <h3>Dewa 19</h3>
                    <p>Venue: Stadion Kridosono</p>
                    <a href="{{ route('schedule.index') }}">Lihat Schedule</a>

                    @if ($dewa)
                        <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form">
                            @csrf
                            <input type="hidden" name="concert_id" value="{{ $dewa->id }}">
                            <button type="submit" class="wishlist-btn">♡ Wishlist</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection