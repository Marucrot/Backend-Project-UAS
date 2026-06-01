<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $fillable = [
        'nama',
        'gmail',
        'password',
        'nik',
        'role',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
