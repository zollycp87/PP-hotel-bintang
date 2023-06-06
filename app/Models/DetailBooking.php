<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBooking extends Model
{
    use HasFactory;

    protected $table = 'detail_booking';
    // public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'invoice',
        'id_kategori',
        'no_kamar'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class,'invoice');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriKamar::class,'id_kategori');
    }
    
}
