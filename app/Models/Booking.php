<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $primaryKey = 'invoice';
    // public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'invoice',
        'tanggal_pesan',
        'start_date',
        'end_date',
        'id_customer',
        'total_bayar',
        'nomor_kamar',
        'status_booking'
    ];



    
    public static function invoice()
    {
        $prefix = 'INV';

        $currentDateTime = Carbon::now();
        $formattedDateTime = $currentDateTime->format('YmdHis');

        $invoiceCode = $prefix . $formattedDateTime;

        return $invoiceCode;
    }
}
