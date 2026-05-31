<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Ticket;
use App\Models\Booking;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('ticket')->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userId = session('pengguna_id');
        $bookings = Booking::where('user_id', $userId)->with('ticket')->get();
        $tickets = $bookings->pluck('ticket');
        return view('reviews.create', compact('tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ticket_id'     => 'required|exists:tickets,id',
            'rating'        => 'required|integer|min:1|max:5',
            'komentar'      => 'nullable',
        ]);

        Review::create([
            'ticket_id' => $request->ticket_id,
            'nama_reviewer' => session('pengguna_nama'),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('reviews.index')->with('success', 'Review berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $tickets = Ticket::all();
        return view('reviews.edit', compact('review', 'tickets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'ticket_id'     => 'required|exists:tickets,id',
            'nama_reviewer' => 'required',
            'rating'        => 'required|integer|min:1|max:5',
            'komentar'      => 'nullable',
        ]);

        $review->update($request->all());
        return redirect()->route('reviews.index')->with('success', 'Review berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review sukses dihapus');
    }
}
