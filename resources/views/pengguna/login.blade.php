@extends('layouts.app')

@section('title', 'Login BeatMeet')
@section('hide_nav', true)

@section('content')
<div class="auth-page">
    <div style="position:absolute;top:22px;left:26px;z-index:3;display:flex;align-items:center;gap:16px;">
        <a href="{{ route('home') }}">
            <img src="{{ asset('resource/image/logo-beatmeet.png') }}" alt="BeatMeet" style="width:75px;border-radius:10px;background:#fff6df;">
        </a>
    </div>

    <div class="auth-card">
        <p class="welcome">WELCOME TO</p>
        <h1>BEATMEET</h1>
        <p class="auth-note">Login untuk booking tiket dan melihat riwayat pemesanan.</p>

        <form action="{{ route('pengguna.prosesLogin') }}" method="POST">
            @csrf

            <div class="field">
                <input type="email" name="gmail" value="{{ old('gmail') }}" placeholder="Email" required>
            </div>

            <div class="field">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="auth-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <div class="auth-links">
            <a href="{{ route('pengguna.register') }}">Buat Akun </a>
            <a href="{{ route('pengguna.forgotPassword') }}">Ganti Password</a>
        </div>
    </div>

    <div class="disc-row">
        <div class="disc"></div>
        <div class="disc"></div>
        <div class="disc"></div>
        <div class="disc"></div>
        <div class="disc"></div>
        <div class="disc"></div>
    </div>
</div>
@endsection
