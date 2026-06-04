<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'concert_id',
        'nama_konser',
        'nama_artis',
        'venue_id',
        'tanggal_konser',
        'jam_konser',
        'harga',
        'stock',
        'tipe_ticket',
    ];

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
