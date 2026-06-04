@extends('layouts.app')

@section('title', 'Edit Gallery')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <h1>Edit Gallery</h1>
        <p>Ubah data foto gallery.</p>
    </section>

    <section class="form-card">
        <form action="{{ route('gallery.update', $gallery->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="field">
                <label>Konser</label>
                <select name="concert_id">
                    <option value="">Pilih konser</option>
                    @foreach($concerts as $concert)
                        <option value="{{ $concert->id }}" {{ old('concert_id', $gallery->concert_id) == $concert->id ? 'selected' : '' }}>{{ $concert->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $gallery->judul) }}">
            </div>

            <div class="field">
                <label>Path Gambar</label>
                <input type="text" name="gambar" value="{{ old('gambar', $gallery->gambar) }}">
            </div>

            <div class="field">
                <label>Preview</label>
                <img src="{{ asset($gallery->gambar) }}" alt="{{ $gallery->judul }}" style="max-width:280px;border-radius:12px;border:1px solid #ddd;">
            </div>

            <div class="field">
                <label>Kategori</label>
                <input type="text" name="kategori" value="{{ old('kategori', $gallery->kategori) }}">
            </div>

            <div class="field">
                <label>Deskripsi</label>
                <textarea name="deskripsi">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
            </div>

            <div class="field">
                <label style="display:flex;gap:8px;align-items:center;font-weight:normal;">
                    <input type="checkbox" name="is_featured" value="1" style="width:auto;" {{ old('is_featured', $gallery->is_featured) ? 'checked' : '' }}>
                    Jadikan featured gallery
                </label>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('gallery.index') }}" class="btn btn-soft">Kembali</a>
            </div>
        </form>
    </section>
</div>
@endsection
