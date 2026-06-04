<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Ticket;
use App\Models\Venue;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private function isAdmin(): bool
    {
        return session('pengguna_role') === 'admin';
    }

    private function guardAdmin()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('tickets.index')->with('error', 'Halaman buat, edit, dan hapus tiket hanya bisa diakses admin.');
        }

        return null;
    }

    public function index()
    {
        $tickets = Ticket::with(['concert.artists', 'venue'])
            ->orderBy('tanggal_konser')
            ->orderBy('jam_konser')
            ->orderBy('harga')
            ->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $concerts = Concert::with('artists')->orderBy('event_date')->get();
        $venues = Venue::orderBy('nama_venue')->get();

        return view('tickets.create', compact('concerts', 'venues'));
    }

    public function store(Request $request)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $validated = $request->validate([
            'concert_id' => 'required|exists:concerts,id',
            'venue_id' => 'required|exists:venues,id',
            'tanggal_konser' => 'required|date',
            'jam_konser' => 'required',
            'harga' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'tipe_ticket' => 'required|in:Regular,VIP',
        ]);

        $concert = Concert::with('artists')->findOrFail($validated['concert_id']);

        Ticket::create([
            'concert_id' => $concert->id,
            'nama_konser' => $concert->name,
            'nama_artis' => $concert->artists->pluck('name')->implode(', '),
            'venue_id' => $validated['venue_id'],
            'tanggal_konser' => $validated['tanggal_konser'],
            'jam_konser' => $validated['jam_konser'],
            'harga' => $validated['harga'],
            'stock' => $validated['stock'],
            'tipe_ticket' => $validated['tipe_ticket'],
        ]);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat dari data konser.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['concert.artists', 'venue']);

        $relatedTickets = Ticket::with(['concert.artists', 'venue'])
            ->where('concert_id', $ticket->concert_id)
            ->where('venue_id', $ticket->venue_id)
            ->orderBy('harga')
            ->get();

        return view('tickets.show', compact('ticket', 'relatedTickets'));
    }

    public function edit(Ticket $ticket)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $concerts = Concert::with('artists')->orderBy('event_date')->get();
        $venues = Venue::orderBy('nama_venue')->get();
        $ticket->load(['concert.artists', 'venue']);

        return view('tickets.edit', compact('ticket', 'concerts', 'venues'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $validated = $request->validate([
            'concert_id' => 'required|exists:concerts,id',
            'venue_id' => 'required|exists:venues,id',
            'tanggal_konser' => 'required|date',
            'jam_konser' => 'required',
            'harga' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'tipe_ticket' => 'required|in:Regular,VIP',
        ]);

        $concert = Concert::with('artists')->findOrFail($validated['concert_id']);

        $ticket->update([
            'concert_id' => $concert->id,
            'nama_konser' => $concert->name,
            'nama_artis' => $concert->artists->pluck('name')->implode(', '),
            'venue_id' => $validated['venue_id'],
            'tanggal_konser' => $validated['tanggal_konser'],
            'jam_konser' => $validated['jam_konser'],
            'harga' => $validated['harga'],
            'stock' => $validated['stock'],
            'tipe_ticket' => $validated['tipe_ticket'],
        ]);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket)
    {
        if ($redirect = $this->guardAdmin()) {
            return $redirect;
        }

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus.');
    }
}
