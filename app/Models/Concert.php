<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'poster_url',
        'event_date',
        'status',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'concert_artist');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
