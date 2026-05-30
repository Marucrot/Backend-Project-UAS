<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model{
  protected $fillable = [
        'nama_konser',
        'nama_artis',
        'venue_id',
        'tanggal_konser',
        'jam_konser',
        'harga',
        'stock',
        'tipe_ticket',
    ];

public function venue()
{
    return $this->belongsTo(Venue::class);
}
}