<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_venue' => 'required',
            'alamat'     => 'required',
            'kota'       => 'required',
            'kapasitas'  => 'required|integer',
        ]);

        Venue::create($request->all());
        return redirect()->route('venues.index')->with('success', 'Venue berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('venues.show', compact('venue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('venues.edit', compact('venue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $request->validate([
            'nama_venue' => 'required',
            'alamat'     => 'required',
            'kota'       => 'required',
            'kapasitas'  => 'required|integer',
        ]);

        $venue->update($request->all());
        return redirect()->route('venues.index')->with('success', 'Venue berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return redirect()->route('venues.index')->with('success', 'Venue berhasil dihapus');
    }
}
