<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Venue;

class TicketController extends Controller
{
    private function groupedConcerts()
    {
        return Ticket::with('venue')
            ->orderBy('tanggal_konser')
            ->orderBy('jam_konser')
            ->get()
            ->groupBy(function ($ticket) {
                return $ticket->nama_konser . '|' . $ticket->venue_id . '|' . $ticket->tanggal_konser . '|' . $ticket->jam_konser;
            })
            ->map(function ($group) {
                $firstTicket = $group->sortBy('harga')->first();

                $firstTicket->min_price = $group->min('harga');
                $firstTicket->ticket_types = $group->sortBy('harga')->pluck('tipe_ticket')->implode(', ');
                $firstTicket->total_stock = $group->sum('stock');

                return $firstTicket;
            })
            ->values();
    }

    public function home()
    {
        $tickets = $this->groupedConcerts();

        return view('welcome', compact('tickets'));
    }

    public function index()
    {
        $tickets = Ticket::with('venue')->orderBy('tanggal_konser')->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {

        $venues = Venue::all();

        return view('tickets.create', compact('venues'));
    }

    public function store(Request $request)
    {
        Ticket::create([
            'nama_konser' => $request->nama_konser,
            'nama_artis' => $request->nama_artis,
            'venue_id' => $request->venue_id,
            'tanggal_konser' => $request->tanggal_konser,
            'jam_konser' => $request->jam_konser,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'tipe_ticket' => $request->tipe_ticket,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Data konser berhasil ditambahkan.');
    }

    public function show(Ticket $ticket)
    {
        $tickets = Ticket::with('venue')
            ->where('nama_konser', $ticket->nama_konser)
            ->where('venue_id', $ticket->venue_id)
            ->where('tanggal_konser', $ticket->tanggal_konser)
            ->where('jam_konser', $ticket->jam_konser)
            ->orderBy('harga')
            ->get();

        return view('tickets.show', compact('ticket', 'tickets'));
    }

    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $venues = Venue::all();

        return view('tickets.edit', compact('ticket', 'venues'));
    }

    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'nama_konser' => $request->nama_konser,
            'nama_artis' => $request->nama_artis,
            'venue_id' => $request->venue_id,
            'tanggal_konser' => $request->tanggal_konser,
            'jam_konser' => $request->jam_konser,
            'harga' => $request->harga,
            'stock' => $request->stock,
            'tipe_ticket' => $request->tipe_ticket,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Data konser berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Data konser berhasil dihapus.');
    }
}