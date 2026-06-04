<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::with('concerts')->get();
        return response()->json($artists);
    }

    public function show($id)
    {
        $artist = Artist::with('concerts')->findOrFail($id);
        return response()->json($artist);
    }

    public function byConcert($concertId)
    {
        $artists = Artist::whereHas('concerts', function ($query) use ($concertId) {
            $query->where('concerts.id', $concertId);
        })->get();

        return response()->json($artists);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'genre'     => 'nullable|string|max:100',
            'bio'       => 'nullable|string',
            'photo_url' => 'nullable|string|max:255',
            'country'   => 'nullable|string|max:100',
        ]);

        $artist = Artist::create($request->all());
        return response()->json($artist, 201);
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $request->validate([
            'name'      => 'sometimes|string|max:255',
            'genre'     => 'sometimes|nullable|string|max:100',
            'bio'       => 'sometimes|nullable|string',
            'photo_url' => 'sometimes|nullable|string|max:255',
            'country'   => 'sometimes|nullable|string|max:100',
        ]);

        $artist->update($request->all());
        return response()->json($artist);
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        $artist->delete();
        return response()->json(['message' => 'Artist deleted successfully']);
    }

    public function attachToConcert($concertId, $artistId)
    {
        $artist = Artist::findOrFail($artistId);
        $artist->concerts()->syncWithoutDetaching([$concertId]);
        return response()->json(['message' => 'Artist attached to concert successfully']);
    }

    public function detachFromConcert($concertId, $artistId)
    {
        $artist = Artist::findOrFail($artistId);
        $artist->concerts()->detach($concertId);
        return response()->json(['message' => 'Artist detached from concert successfully']);
    }
}