<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'nama_venue',
        'alamat',
        'kota',
        'kapasitas',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}