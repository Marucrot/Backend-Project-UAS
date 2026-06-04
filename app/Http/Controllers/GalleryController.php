<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    private function isAdmin(): bool
    {
        return session('pengguna_role') === 'admin';
    }

    private function guardAdmin()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('gallery.index')->with('error', 'Hanya admin yang bisa menambah, mengubah, dan menghapus gallery.');
        }

        return null;
    }

    public function index()
    {
        $galleries = Gallery::with('concert')
            ->latest()
            ->get();

        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $concerts = Concert::orderBy('event_date')->get();

        return view('gallery.create', compact('concerts'));
    }

    public function store(Request $request)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $validated = $request->validate([
            'concert_id' => 'nullable|exists:concerts,id',
            'judul' => 'required|string|max:255',
            'gambar' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        Gallery::create($validated);

        return redirect()->route('gallery.index')->with('success', 'Gallery berhasil ditambahkan.');
    }

    public function show(Gallery $gallery)
    {
        $gallery->load('concert');

        return view('gallery.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $concerts = Concert::orderBy('event_date')->get();

        return view('gallery.edit', compact('gallery', 'concerts'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $validated = $request->validate([
            'concert_id' => 'nullable|exists:concerts,id',
            'judul' => 'required|string|max:255',
            'gambar' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:100',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        $gallery->update($validated);

        return redirect()->route('gallery.index')->with('success', 'Gallery berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Gallery berhasil dihapus.');
    }
}
