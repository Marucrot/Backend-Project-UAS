<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::with('artists')->get();
        return response()->json($concerts);
    }

    public function show($id)
    {
        $concert = Concert::with('artists')->findOrFail($id);
        return response()->json($concert);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'event_date' => 'required|date',
            'description'=> 'nullable|string',
            'poster_url' => 'nullable|string|max:255',
            'status'     => 'in:upcoming,ongoing,finished',
        ]);

        $concert = Concert::create($request->all());
        return response()->json($concert, 201);
    }

    public function update(Request $request, $id)
    {
        $concert = Concert::findOrFail($id);

        $request->validate([
            'name'        => 'sometimes|string|max:255',
            'event_date'  => 'sometimes|date',
            'description' => 'sometimes|nullable|string',
            'poster_url'  => 'sometimes|nullable|string|max:255',
            'status'      => 'sometimes|in:upcoming,ongoing,finished',
        ]);

        $concert->update($request->all());
        return response()->json($concert);
    }

    public function destroy($id)
    {
        $concert = Concert::findOrFail($id);
        $concert->delete();
        return response()->json(['message' => 'Concert deleted successfully']);
    }
}