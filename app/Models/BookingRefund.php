<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingRefund extends Model
{
    protected $fillable = [
        'booking_id',
        'pengguna_id',
        'alasan',
        'status',
        'catatan_admin',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}
