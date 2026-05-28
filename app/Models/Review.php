<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'ticket_id',
        'nama_reviewer',
        'rating',
        'komentar',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}