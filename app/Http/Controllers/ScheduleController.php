<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Ticket::with(['concert.artists', 'venue'])
            ->orderBy('tanggal_konser')
            ->orderBy('jam_konser')
            ->get()
            ->groupBy(function ($ticket) {
                return $ticket->concert_id . '-' . $ticket->venue_id . '-' . $ticket->tanggal_konser . '-' . $ticket->jam_konser;
            })
            ->map(function ($group) {
                $jadwal = $group->first();

                $jadwal->tipe_tiket = $group->pluck('tipe_ticket')->implode(', ');
                $jadwal->harga_mulai = $group->min('harga');
                $jadwal->total_stock = $group->sum('stock');

                return $jadwal;
            })
            ->values();

        return view('schedules.index', compact('schedules'));
    }
}
