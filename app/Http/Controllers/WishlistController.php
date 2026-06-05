<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login');
        }

        $wishlists = Wishlist::with('concert')
            ->where('pengguna_id', session('pengguna_id'))
            ->latest()
            ->get();

        return view('wishlists.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
    if (!session('pengguna_id')) {
            return redirect()->route('pengguna.login');
        }

        $request->validate([
            'concert_id' => 'required|exists:concerts,id',
        ]);

        Wishlist::firstOrCreate([
            'pengguna_id' => session('pengguna_id'),
            'concert_id' => $request->concert_id,
        ]);

        return redirect()->back()->with('success', 'Konser berhasil ditambahkan ke wishlist.');
    }
    
    public function destroy($id)
    {

    }
}