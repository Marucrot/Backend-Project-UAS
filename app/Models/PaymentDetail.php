<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $fillable = [
        'payment_id',
        'nama_bank',
        'nomor_rekening',
        'nama_pengirim',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
