<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBayar extends Model
{
    use HasFactory;

    protected $table = 'detail_bayar';
    // public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'invoice',
        'total_bayar',
        'tanggal_bayar',
        'status_bayar',
        'bukti_bayar'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class,'invoice');
    }
    
}
