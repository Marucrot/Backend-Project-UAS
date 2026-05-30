<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Booking::all();
        return view('booking.index', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tickets = Ticket::all();
        return view('booking.create', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);

        Booking::create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
            'nama_konser' => $ticket->nama_konser,
            'nama_artis' => $ticket->nama_artis,
            'venue' => $ticket->venue,
            'tanggal_konser' => $ticket->tanggal_konser,
            'jam_konser' => $ticket->jam_konser,
            'tipe_ticket' => $ticket->tipe_ticket,
            'kuantitas' => $request->kuantitas,
            'total_harga' => $ticket->harga * $request->kuantitas,
            'status' => 'pending',
        ]);

        return redirect('/booking');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
