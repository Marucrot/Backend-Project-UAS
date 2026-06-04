<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = [
        'pengguna_id',
        'concert_id',
    ];

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}