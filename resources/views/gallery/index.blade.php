@extends('layouts.app')

@section('title', 'Gallery BeatMeet')

@section('content')
<div class="page-shell">
    <section class="hero-panel">
        <h1>Gallery Konser</h1>
        <p>Dokumentasi visual konser dan artist yang tampil di BeatMeet.</p>
    </section>

    <section class="content-card">
        <div class="section-head">
            <div>
                <h2>Daftar Gallery</h2>
                <p class="muted" style="margin:6px 0 0;">Klik detail untuk melihat gambar lebih besar.</p> 
            </div>

            @if(session('pengguna_role') === 'admin')
                <a href="{{ route('gallery.create') }}" class="btn btn-primary">Tambah Gallery</a>
            @endif
        </div>

        @if($galleries->isEmpty())
            <div class="empty-state">Belum ada data gallery.</div>
        @else
            <div class="grid grid-3">
                @foreach($galleries as $gallery)
                    <div class="event-card">
                        <img src="{{ asset($gallery->gambar) }}" alt="{{ $gallery->judul }}" style="width:100%;height:210px;object-fit:cover;display:block;">

                        <div style="padding:18px;">
                            @if($gallery->is_featured)
                                <span class="badge green">Featured</span>
                            @else
                                <span class="badge">{{ ucfirst($gallery->kategori) }}</span>
                            @endif

                            <h3 style="margin:6px 0;">{{ $gallery->judul }}</h3>
                            <p class="muted small" style="margin:0 0 12px;">{{ $gallery->concert->name ?? 'Tanpa konser' }}</p>
                            <p class="small" style="line-height:1.5;min-height:42px;">{{ $gallery->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                            <div class="actions">
                                <a href="{{ route('gallery.show', $gallery->id) }}" class="btn btn-soft">Detail</a>

                                @if(session('pengguna_role') === 'admin')
                                    <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-dark">Edit</a>

                                    <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus gallery ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</div>
@endsection
