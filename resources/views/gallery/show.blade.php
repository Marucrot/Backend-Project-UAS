@extends('layouts.app')

@section('title', 'Detail Gallery')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <h1>{{ $gallery->judul }}</h1>
        <p>{{ $gallery->concert->name ?? 'Gallery umum BeatMeet' }}</p>
    </section>

    <section class="content-card">
        <img src="{{ asset($gallery->gambar) }}" alt="{{ $gallery->judul }}" style="width:100%;max-height:520px;object-fit:contain;background:#17223a;border-radius:16px;">

        <div style="margin-top:18px;">
            <span class="badge {{ $gallery->is_featured ? 'green' : '' }}">{{ $gallery->is_featured ? 'Featured' : ucfirst($gallery->kategori) }}</span>
            <h2 style="margin:8px 0;">{{ $gallery->judul }}</h2>
            <p class="muted" style="line-height:1.6;">{{ $gallery->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <div class="actions" style="margin-top:18px;">
            <a href="{{ route('gallery.index') }}" class="btn btn-soft">Kembali</a>

            @if(session('pengguna_role') === 'admin')
                <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-dark">Edit</a>
            @endif
        </div>
    </section>
</div>
@endsection
