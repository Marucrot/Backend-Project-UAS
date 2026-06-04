@extends('layouts.app')

@section('title', 'Tambah Gallery')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <h1>Tambah Gallery</h1>
        <p>Tambahkan foto konser atau artist ke halaman gallery.</p>
    </section>

    <section class="form-card">
        <form action="{{ route('gallery.store') }}" method="POST">
            @csrf

            <div class="field">
                <label>Konser</label>
                <select name="concert_id">
                    <option value="">Pilih konser</option>
                    @foreach($concerts as $concert)
                        <option value="{{ $concert->id }}" {{ old('concert_id') == $concert->id ? 'selected' : '' }}>{{ $concert->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Judul</label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Gallery Bruno Mars">
            </div>

            <div class="field">
                <label>Path Gambar</label>
                <input type="text" name="gambar" value="{{ old('gambar') }}" placeholder="Contoh: resource/image/bruno.jpg">
                <p class="muted small">Simpan gambar di folder public/resource/image, lalu isi path-nya di sini.</p>
            </div>

            <div class="field">
                <label>Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori', 'concert') }}">
            </div>

            <div class="field">
                <label>Deskripsi</label>
                <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="field">
                <label style="display:flex;gap:8px;align-items:center;font-weight:normal;">
                    <input type="checkbox" name="is_featured" value="1" style="width:auto;" {{ old('is_featured') ? 'checked' : '' }}>
                    Jadikan featured gallery
                </label>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-soft">Kembali</a>
            </div>
        </form>
    </section>
</div>
@endsection
