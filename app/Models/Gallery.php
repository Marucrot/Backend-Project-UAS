<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'concert_id',
        'judul',
        'gambar',
        'deskripsi',
        'kategori',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function concert()
    {
        return $this->belongsTo(Concert::class);
    }
}
