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
 
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
 
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}